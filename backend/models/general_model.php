<?php  
/**********************************
	Programmer: Nguyen Dang Khoa
**********************************/
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class General_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
/**********************************  CATEGORY MANAGER  ***********************************/

//create view full_category AS Select category.category_id,icon,parent_id,sort_order,active,name,name_alias,info from category JOIN category_description ON category.category_id =category_description.category_id

	function get_all_category($id='') // type: 1 product; 2 article // active: 0 show all ; 1 only active
	{
		$this->db->select('*');
		$this->db->from('category');
		$this->db->order_by('sort_order','desc');
		$this->db->join('category_description', 'category.category_id = category_description.category_id');
		
		if($id!='')
		{
			$this->db->where('category.category_id',$id);
		}
		$query = $this->db->get();		
		return $query;
	}
	
	function getPath($category_id) 
	{
		$sql = "SELECT name, parent_id FROM category c LEFT JOIN category_description cd ON (c.category_id = cd.category_id) WHERE c.category_id = " . (int)$category_id . " and language_code='".$this->config->item('default_langcode')."'  ORDER BY c.sort_order, cd.name ASC";
		
		$query = $this->db->query($sql);
		foreach ($query->result_array() as $category_info) 
		{
		  if ($category_info['parent_id']) 
		  {
			  return $this->getPath($category_info['parent_id']). " >> " . $category_info['name']; // Sports >> Football
		  } 
		  else 
		  {
			  return $category_info['name'];
		  }
		}
	}
	
	function get_category_item($id)
	{

		$this->db->from('category');
		$this->db->join('category_description', 'category.category_id = category_description.category_id');
		$this->db->where('category.category_id',$id);
		$this->db->where('language_code',$this->config->item('default_langcode'));
		$query = $this->db->get();
		return $query;
	}
	function publish_category($id,$status)
	{
		$this->db->trans_start();
		
		$this->db->set('active',!$status);
		$this->db->where('category_id',$id);
		$this->db->update('category');
		
		$this->db->trans_complete();
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}

	function add_category($data) 
	{
		$this->db->trans_start(); 
		$config['upload_path'] = $this->config->item('category_file_location');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= $this->config->item('max_image_size');
		$config['encrypt_name']	=TRUE;    // rename to random string
		if($_FILES['userfile']['name'])
		{
			$this->load->library('upload', $config);
			
				if ( $this->upload->do_upload())
				{	
						$datax=$this->upload->data();
				}
				else
				{
					return -1;
				}
		}
		else
		{
			$datax['file_name']=NULL;				
		}
			$this->db->set('parent_id',$data['category']);
			$this->db->set('icon',$datax['file_name']);
			$this->db->set('active',$data['publish']);
			$this->db->set('special',$data['special']);
			$this->db->set('sort_order',$data['sorting']);
			$this->db->set('category_type_id',$data['type_category']);// $type: article or product category
			$this->db->insert('category'); 
			$id=$this->db->insert_id();			

			$arr['seo'] =seo_url($data['name']); // load from helper
			$this->db->set('category_id',$id);
			$this->db->set('language_code',$this->config->item('default_langcode'));
			$this->db->set('name',$data['name']);
			//$this->db->set('name_alias',$arr['seo']);
			$this->db->set('info',$data['description']);
			
			$this->db->insert('category_description');
			
			$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}

	function update_category($data)
	{
		$this->db->trans_start(); 
		$config['upload_path'] = $this->config->item('category_file_location');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= $this->config->item('max_image_size');
		$config['encrypt_name']	=TRUE;    // rename to random string
		if($_FILES['userfile']['name'])
		{
			$this->load->library('upload', $config);
			
				if ( $this->upload->do_upload())
				{	
						$datax=$this->upload->data();
						$this->db->set('icon',$datax['file_name']);
				}
				else
				{
					return -1;
				}
		}
			$this->db->set('sort_order',$data['sorting']);
			$this->db->where('category_id',$data['id']);
			$this->db->update('category'); 

			$arr['seo'] =seo_url($data['name']); // load from helper			
			$this->db->set('name',$data['name']);
			//$this->db->set('name_alias',$arr['seo']);
			$this->db->set('info',$data['maincontent']);
			$this->db->where('category_id',$data['id']);
			$this->db->update('category_description');
			
			$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}	

	function delete_article_category($id)
	{
		$this->db->trans_start(); 
		/*
				delete this category
				check if this category in article ID: 
				remove this ID from IDlists
					1/ the remain IDLIST= NULL --> delete this article
					2/ update the IDLists
				delete the comment of article
		*/
		$this->do_delete_article_comment($id);
		$this->do_delete_allsubcategory($id);
		$this->db->delete('category', array('category_id' => $id));
		$this->db->trans_complete();
		//exit;
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	function delete_product_category($id)
	{
		$this->db->trans_start(); 
		/*
				delete this category
				check if this category in article ID: 
				remove this ID from IDlists
					1/ the remain IDLIST= NULL --> delete this article
					2/ update the IDLists
				delete the comment of article
		*/
		//$this->do_delete_article_comment($id);
		$this->do_delete_allsubcategory($id);
		$this->db->delete('category', array('category_id' => $id));
		$this->db->trans_complete();
		//exit;
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	function do_delete_allsubcategory($parent_id)
	{
		$sql="SELECT category_id FROM category where parent_id = " . (int)$parent_id ;
		$query = $this->db->query($sql);
		$results=$query->result_array();
		foreach($results as $result )
		{
			
			$this->db->delete('category', array('category_id' => $result['category_id']));
			$this->do_delete_article_comment($result['category_id']);
			$this->do_delete_allsubcategory($result['category_id']);
		}

	}
	function do_delete_article_comment($id)
	{
		$sql="SELECT distinct id, article.category_id FROM (category) JOIN article ON POSITION(CONCAT(',',".$id.",',')  IN article.category_id ) <>0";
		$query = $this->db->query($sql);
		$results=$query->result_array();
		foreach($results as $result )
		{	
			$temp=','.$id.',';
			$temp=str_replace($temp,',',$result['category_id']);
			if($temp==',')
			{
				//echo "delete this article -- delete comment<br>";
				$this->db->delete('article', array('id' => $result['id']));
				$this->db->delete('comments', array('item_id' => $result['id'],'type' =>0));
			}
			else
			{
				//echo "update new category_id<br>";
				$this->db->set('category_id',$temp);
				$this->db->where('id',$result['id']);
				$this->db->update('article'); 
				
			}
		}

		/*$a=",2,";
		$b=",1,8,14,5,3,";
		echo "<br>".preg_match($a,$b);
		$b=str_replace($a,',',$b);
		echo "<br>".$b;*/
	}

/**********************************  END CATEGORY MANAGER  ***********************************/

/**********************************  COMMENTS  ***********************************/
	//$type: 0 --> article; 1 --> product
	// $active:  all --> show all,  1 -->  active;   0 --> inactive
	
	function get_all_comment($active,$keyword,$type,$num, $offset)
	{
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('comments');
		if($keyword!='')
		{
			$this->db->like("title",$keyword);
		}
		if(($active!='') && ($active!='all'))
		{
			$this->db->where("active",$active);
		}
		if($type!='')
		{
			$this->db->where("type",$type);
		}
		$this->db->order_by("thedate", "desc");
		$query = $this->db->get();		
		return $query;
	}
	function get_totalrow_comment($active,$keyword,$type)
	{
		$this->db->from('comments');
		if($keyword!='')
		{
			$this->db->like("title",$keyword);
		}
		if(($active!='') && ($active!='all'))
		{
			$this->db->where("active",$active);
		}
		if($type!='')
		{
			$this->db->where("type",$type);
		}
		return $this->db->count_all_results();
	}
	function get_comment_detail($id,$type)
	{
		$this->db->select('article_description.title a_title, id,comments.title  c_title,comments.content,comments.thedate ');
		$this->db->from('comments');
		$this->db->join('article_description', 'comments.item_id = article_description.article_id');
		$this->db->where('comments.id',$id);
		if($type!='')
		{
			$this->db->where("type",$type);
		}
		$query = $this->db->get();		
		return $query;
	}
	function delete_comment($id,$type)
	{
		$this->db->trans_start(); 
		$this->db->delete('comments', array('id' => $id, 'type' =>$type));
		$this->db->trans_complete();
		
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	function update_comment($arr,$type)
	{
		$this->db->trans_start(); 
		$this->db->set('title',$arr['title']);
		$this->db->set('content',$arr['maincontent']);
		$this->db->update('comments', array('id' => $arr['currentid'], 'type' =>$type));
		$this->db->trans_complete();
		
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	function get_information_general($id='')
	{
		$this->db->select('*');
		$this->db->from('information');
		$this->db->join('information_description', 'information.information_id = information_description.information_id');
		
		if($id!='')
		{
			$this->db->where('information.information_id',$id);
		}
		$query = $this->db->get();		
		return $query;
	}
	function update_information_general($arr)
	{
		$this->db->trans_start(); 
		$config['upload_path'] = $this->config->item('article_file_location');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= $this->config->item('max_image_size');
		$config['encrypt_name']	=TRUE;    // rename to random string
		if($_FILES['userfile']['name'])
		{
			$this->load->library('upload', $config);
			
				if ( $this->upload->do_upload())
				{	
						$datax=$this->upload->data();
						$this->db->set('thumb_img',$datax['file_name']);
				}
				else
				{
					return -1;
				}
		}
		$this->db->set('title',$arr['title']);
		$this->db->set('description',$arr['maincontent']);
		$this->db->where('information_id',$arr['id']);
		$this->db->update('information_description');
		$this->db->trans_complete();
		
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}

/**********************************  END COMMENTS  ***********************************/
	function get_all_manufacture($id='',$active='')
	{
		$this->db->select('*');
		$this->db->from('manufacturer');
		
		if($id!='')
		{
			$this->db->where('manufacturer_id',$id);
		}
		if($active!='')
		{
			$this->db->where('active',$active);
		}
		$this->db->order_by('sort_order','desc');
		$query = $this->db->get();		
		return $query;
	}

	function add_manufacturer($data) 
	{
		$this->db->trans_start(); 
		$config['upload_path'] = $this->config->item('manufacturer_file_location');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= $this->config->item('max_image_size');
		$config['encrypt_name']	=TRUE;    // rename to random string
		if($_FILES['userfile']['name'])
		{
			$this->load->library('upload', $config);
			
				if ( $this->upload->do_upload())
				{	
						$datax=$this->upload->data();
				}
				else
				{
					return -1;
				}
		}
		else
		{
			$datax['file_name']=NULL;				
		}
			$this->db->set('name',$data['name']);
			$this->db->set('keyword',$data['description']);
			$this->db->set('logo',$datax['file_name']);
			$this->db->set('active',$data['publish']);
			$this->db->set('sort_order',$data['sorting']);
			$this->db->insert('manufacturer'); 
			
			$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	function update_manufacturer($data) 
	{
		$this->db->trans_start(); 
		$config['upload_path'] = $this->config->item('manufacturer_file_location');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= $this->config->item('max_image_size');
		$config['encrypt_name']	=TRUE;    // rename to random string
		if($_FILES['userfile']['name'])
		{
			$this->load->library('upload', $config);
			
				if ( $this->upload->do_upload())
				{	
						$datax=$this->upload->data();
						$this->db->set('logo',$datax['file_name']);
				}
				else
				{
					return -1;
				}
		}
			$this->db->set('name',$data['name']);
			$this->db->set('keyword',$data['description']);
			$this->db->set('active',$data['publish']);
			$this->db->set('sort_order',$data['sorting']);
			$this->db->where('manufacturer_id',$data['currentid']);
			$this->db->update('manufacturer'); 
			
			$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	
	}

	function publish_manufacturer($id,$status)
	{
		$this->db->trans_start();
		
		$this->db->set('active',!$status);
		$this->db->where('manufacturer_id',$id);
		$this->db->update('manufacturer');
		
		$this->db->set('status',!$status);
		$this->db->where('manufacturer_id',$id);
		$this->db->update('product');
		
		$this->db->trans_complete();
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	function delete_manufacturer($id)
	{
		$this->db->trans_start(); 
		$this->db->delete('manufacturer', array('manufacturer_id' => $id));
		$this->db->trans_complete();
		
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
// ================================ MAKE CHART ====================================
	function get_category_product_statistic()
	{
		$sql="SELECT name,count(id) AS totalnum FROM (category_description) LEFT JOIN `portfolio` ON category_description.category_id=portfolio.category_id Group by category_description.name order by totalnum desc";
		$query = $this->db->query($sql);
		return $query;	
	}
// UPDATE ADMIN INFORMATION

	function update_admin_account($arr)
	{
		$this->db->trans_start();
		
		if($arr['newpassword']!='')
		{
			$this->db->set('password',md5($arr['newpassword']));
		}
		
		$this->db->set('fullname',$arr['fullname']);
		$this->db->set('email',$arr['email']);
		$this->db->set('phone',$arr['phone']);
		$this->db->set('nickyahoo',$arr['yahoo']);
		$this->db->set('nickskype',$arr['skype']);
		$this->db->where('ua_user_id ',1);
		$this->db->update('ua_users');
		
		$this->db->trans_complete();
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}

	}
}