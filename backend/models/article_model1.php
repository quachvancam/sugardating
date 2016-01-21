<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Article_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function get_all_article($num, $offset)
	{
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('article_description');
		$this->db->join('article', 'article.id = article_description.article_id');
		$this->db->order_by("thedate", "desc");
		$query = $this->db->get();		
		return $query;
	}
	function get_totalrow_article()
	{
		$this->db->from('article_description');
		$this->db->join('article', 'article.id = article_description.article_id');
		return $this->db->count_all_results();
	}
	
	function add_article($data)
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
			$this->db->set('category_id',1);
			$this->db->set('small_img',$datax['file_name']);
			$this->db->set('thedate',time());
			$this->db->set('pageview',1);
			$this->db->set('active',1);
			$this->db->set('is_private',1);
			$this->db->insert('article'); 
			$id=$this->db->insert_id();			

			$arr['seo'] =seo_url($data['title']); // load from helper
			$this->db->set('article_id',$id);
			$this->db->set('language_code',$this->config->item('default_langcode'));
			$this->db->set('title',$data['title']);
			$this->db->set('title_alias',$arr['seo']);
			$this->db->set('small_info','');
			$this->db->set('content',$data['maincontent']);
			$this->db->insert('article_description');
			
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

	function update_article($data)
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
						$this->db->set('small_img',$datax['file_name']);
						$this->db->where('id',$data['id']);
						$this->db->update('article'); 
				}
				else
				{
					return -1;
				}
		}
			//$this->db->set('thedate',time());
			

			$arr['seo'] =seo_url($data['title']); // load from helper
			$this->db->set('title',$data['title']);
			$this->db->set('title_alias',$arr['seo']);
			$this->db->set('content',$data['maincontent']);
			$this->db->where('article_id',$data['id']);
			$this->db->update('article_description');
			
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
	function get_article($id)
	{
		$this->db->select('*');
		$this->db->from('article_description');
		$this->db->join('article', 'article.id = article_description.article_id');
		$this->db->where('article.id',$id);
		$query = $this->db->get();		
		return $query;
	}
	

	function delete_article($id)
	{
		$this->db->trans_start(); 
		$this->db->delete('article', array('id' => $id));
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
	function publish_article($id,$status)
	{
		$this->db->trans_start();
		
		$this->db->set('active',!$status);
		$this->db->where('id',$id);
		$this->db->update('article');
		$this->db->set('active',!$status);
		$this->db->where('item_id',$id);
		$this->db->update('comments');
		
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
/*************************************LIDESHOW*******************************************/
	function get_slideshow($id='')
	{
		$this->db->select('*');
		$this->db->order_by('sorting','desc');
		$this->db->from('slideshow');
		if($id!='')
		{
			$this->db->where('id',$id);
		}
		$query = $this->db->get();		
		return $query;
	}
	
	function add_slideshow($data)
	{
		$this->db->trans_start(); 
		
		$config['upload_path'] = $this->config->item('slideshow_file_location');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= $this->config->item('max_image_size');
		$config['encrypt_name']	=TRUE;    // rename to random string
		if($_FILES['userfile']['name'])
		{
			$this->load->library('upload', $config);
			
				if ( $this->upload->do_upload())
				{	
						$datax=$this->upload->data();
						$this->db->set('image',$datax['file_name']);
				}
				else
				{
					return -1;
				}
		}

			$this->db->set('title',$data['title']);
			
			$this->db->set('content',$data['maincontent']);
			$this->db->set('sorting',$data['sorting']);
			
			if($data['id']!='') // update
			{
				$this->db->where('id',$data['id']);
				$this->db->update('slideshow');
			}
			else
			{
				$this->db->insert('slideshow');
			}
			
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
/*************************************TESTIMONIAL*******************************************/
	function get_testimonial($num, $offset)
	{
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->order_by('sorting','desc');
		$this->db->from('testimonials');
		$query = $this->db->get();		
		return $query;
	}
	function get_totalrow_testiminial()
	{
		$this->db->from('testimonials');
		return $this->db->count_all_results();
	}

	function get_testimonial_detail($id='')
	{
		$this->db->select('*');
		$this->db->order_by('sorting','desc');
		$this->db->from('testimonials');
		$this->db->where('id',$id);
		$query = $this->db->get();		
		return $query;
	}
	
	function add_testimonial($data)
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
						$this->db->set('image',$datax['file_name']);
				}
				else
				{
					return -1;
				}
		}

			$this->db->set('title',$data['title']);
			$this->db->set('website',$data['website']);
			$this->db->set('author',$data['author']);
			
			$this->db->set('content',$data['maincontent']);
			$this->db->set('sorting',$data['sorting']);
			
			if($data['id']!='') // update
			{
				$this->db->where('id',$data['id']);
				$this->db->update('testimonials');
			}
			else
			{
				$this->db->insert('testimonials');
			}
			
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
// =========================== SEARCH ==============================
	function get_search($data,$type='')
	{
		if($type=='article')
		{
			$this->db->select('*');
			$this->db->from('article_description');
			$this->db->join('article', 'article.id = article_description.article_id');
			$this->db->like('title', $data['keyword']);
		  	$this->db->or_like('content', $data['keyword']); 
			$this->db->order_by("thedate", "desc");
		}
		else if($type=='portfolio')
		{
			$this->db->select('*');
			$this->db->from('portfolio_description');
			$this->db->join('portfolio', 'portfolio.id = portfolio_description.portfolio_id');
			$this->db->like('title', $data['keyword']);
		  	$this->db->or_like('content', $data['keyword']); 
			$this->db->or_like('company_name', $data['keyword']);
			$this->db->order_by("thedate", "desc");
		}
		else if($type=='video')
		{
			$this->db->select('*');
			$this->db->from('video');
			$this->db->like('title', $data['keyword']);
		  	$this->db->or_like('description', $data['keyword']); 
			$this->db->order_by("id", "desc");
		}
		else // testimonial
		{
		  $this->db->select('*');
		  $this->db->order_by('sorting','desc');
		  $this->db->like('title', $data['keyword']);
		  $this->db->or_like('content', $data['keyword']); 
		  $this->db->or_like('author', $data['keyword']);
		  $this->db->or_like('website',$data['keyword']); 
		  $this->db->from('testimonials');
		}
		$query = $this->db->get();		
		return $query;
	}
	/*=================================================*/
	function get_all_portfolio($num, $offset)
	{
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('portfolio_description');
		$this->db->join('portfolio', 'portfolio.id = portfolio_description.portfolio_id');
		$this->db->order_by("thedate", "desc");
		$query = $this->db->get();		
		return $query;
	}
	function get_all_video($num, $offset)
	{
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('video');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();		
		return $query;
	}
	function section_detail($cate_id,$num, $offset)
	{
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('portfolio_description');
		$this->db->join('portfolio', 'portfolio.id = portfolio_description.portfolio_id');
		$this->db->where('category_id',$cate_id);
		$this->db->order_by("thedate", "desc");
		$query = $this->db->get();		
		return $query;
	}
	function get_totalrow_portfolio($id='')
	{
		$this->db->from('portfolio_description');
		$this->db->join('portfolio', 'portfolio.id = portfolio_description.portfolio_id');
		if($id!='')
		{
			$this->db->where('category_id',$id);
		}
		return $this->db->count_all_results();
	}
	function get_totalrow_video($id='')
	{
		$this->db->from('video');
		if($id!='')
		{
			$this->db->where('id',$id);
		}
		return $this->db->count_all_results();
	}
	function add_portfolio($data)
	{
		$this->db->trans_start(); 
		
		$config['upload_path'] = $this->config->item('file_file_location');
		$config['allowed_types'] = 'gif|jpg|jpeg|png|flv|mp4';
		$config['max_size']	= $this->config->item('max_image_size');
		$config['encrypt_name']	=TRUE;    // rename to random string
			$this->db->set('category_id',$data['category']);
			//$this->db->set('small_img',$datax['file_name']);
			$this->db->set('thedate',time());
			$this->db->insert('portfolio'); 
			$id=$this->db->insert_id();			

			$this->db->set('portfolio_id',$id);
			$this->db->set('title',$data['title']);
			$this->db->set('company_name',$data['company_name']);
			$this->db->set('content',$data['maincontent']);
			$this->db->insert('portfolio_description');
			$this->load->library('upload', $config);

		// insert media
		for($i=1;$i<6;$i++)
		{
			//unset($datax['file_name']);
			//unset($datathumb['file_name']);
			if($_FILES['userfile'.$i]['name'])
			{
					if ( $this->upload->do_upload('userfile'.$i))
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
			if($_FILES['thumb'.$i]['name'])
			{				
					if ( $this->upload->do_upload('thumb'.$i))
					{	
							$datathumb=$this->upload->data();
					}
					else
					{
						return -1;
					}
			}
			else
			{
				$datathumb['file_name']=NULL;				
			}
			$temp=0;
			$this->db->set('portfolio_id',$id);
			$this->db->set('media_file',$datax['file_name']);
			$this->db->set('thumbnail',$datathumb['file_name']);
			if(isset($data['default']) && ($data['default']==$i))
			{
				$this->db->set('default',$data['default']);
				$temp++;
			}
			else
			{
				$this->db->set('default',0);
				$temp++;
			}
			$this->db->set('no',$i);
			$this->db->insert('media');
		}
	
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
	function update_portfolio($data)
	{
		$this->db->trans_start(); 
		
		$config['upload_path'] = $this->config->item('file_file_location');
		$config['allowed_types'] = 'gif|jpg|jpeg|png|flv|mp4';
		$config['max_size']	= $this->config->item('max_image_size');
		$config['encrypt_name']	=TRUE;    // rename to random string
		
			$this->db->set('category_id',$data['category']);
			$this->db->where('id',$data['id']);
			$this->db->update('portfolio');
			
			$this->db->set('title',$data['title']);
			$this->db->set('company_name',$data['company_name']);
			$this->db->set('content',$data['maincontent']);
			$this->db->where('portfolio_id',$data['id']);
			$this->db->update('portfolio_description');
			$this->load->library('upload', $config);
		// insert media
		for($i=1;$i<6;$i++)
		{
			
			
			if($_FILES['userfile'.$i]['name'])
			{
					if ( $this->upload->do_upload('userfile'.$i))
					{	
							$datax=$this->upload->data();
							
					}
					else
					{
						return -1;
					}
			}
			if($_FILES['thumb'.$i]['name'])
			{				
					if ( $this->upload->do_upload('thumb'.$i))
					{	
							$datathumb=$this->upload->data();
					}
					else
					{
						return -1;
					}
			}
			
			$this->db->where('portfolio_id',$data['id']);
			$this->db->where('no',$i);
			$temp=0;
			if(isset($datax['file_name']))
			{
				$this->db->set('media_file',$datax['file_name']);
				$temp++;
				unset($datax['file_name']);
			}
			if(isset($datathumb['file_name']))
			{
				$this->db->set('thumbnail',$datathumb['file_name']);
				$temp++;
				unset($datathumb['file_name']);
			}
			if(isset($data['default']) && ($data['default']==$i))
			{
				$this->db->set('default',$data['default']);
				$temp++;
			}
			else
			{
				$this->db->set('default',0);
				$temp++;
			}
			if($temp>0)
			{
				$this->db->update('media');
			}
			
		}	
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
	function add_video($data)
	{
		$this->db->trans_start(); 
			$this->db->set('author',$data['author']);
			$this->db->set('title',$data['title']);
			$this->db->set('videocode',$data['videocode']);
			$this->db->set('description',$data['maincontent']);
			$this->db->set('thedate',time());
			$this->db->insert('video');
	
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

	function update_video($data)
	{
		$this->db->trans_start(); 
		
			$this->db->set('title',$data['title']);
			$this->db->set('author',$data['author']);
			$this->db->set('description',$data['maincontent']);
			$this->db->set('videocode',$data['videocode']);
			$this->db->where('id',$data['id']);
			$this->db->update('video');
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
	function get_portfolio($id)
	{
		$this->db->select('*');
		$this->db->from('portfolio_description');
		$this->db->join('portfolio', 'portfolio.id = portfolio_description.portfolio_id');
		$this->db->where('portfolio.id',$id);
		$query = $this->db->get();		
		return $query;
	}
	function get_video($id)
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->where('id',$id);
		$query = $this->db->get();		
		return $query;
	}

	function delete_portfolio($id)
	{
		$this->db->trans_start(); 
		$this->db->delete('portfolio', array('id' => $id));
		$this->db->trans_complete();
		$result_categories=$this->db->query('select * from media where portfolio_id='.$id);
		if($result_categories->num_rows()>0)
		{
			$categories=$result_categories->result_array();
			foreach ($categories as $row)
			{
				$myfile=$row['media_file'];
				$myfile2=$row['thumbnail'];
				if($myfile!='')
				{
					if(is_file($this->config->item('file_file_location').$myfile)) 
					{
						unlink($this->config->item('file_file_location').$myfile);
					}
				}
				if($myfile2!='')
				{
					if(is_file($this->config->item('file_file_location').$myfile2)) 
					{
						unlink($this->config->item('file_file_location').$myfile2);
					}
				}
			}
		}
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	function delete_video($id)
	{
		$this->db->trans_start(); 
		$this->db->delete('video', array('id' => $id));
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
	function get_media($id)
	{
		$this->db->select('*');
		$this->db->from('media');
		$this->db->where('portfolio_id',$id);
		$this->db->order_by('no');
		$query = $this->db->get();		
		return $query;
	}

}