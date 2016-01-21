<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Product_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function get_all_product($is_private,$keyword,$catergory,$num, $offset)
	{
		$this->db->limit($num, $offset);
		$this->db->select('*');
		$this->db->from('product_description');
		$this->db->join('product', 'product.product_id = product_description.product_id');
		if($keyword!='')
		{
			$this->db->like("title",$keyword);
		}
		if($catergory!='')
		{
			$this->db->where("category_id",$catergory);
		}

		$this->db->where('language_code',$this->config->item('default_langcode'));
		$this->db->order_by("product.product_id", "desc");
		$query = $this->db->get();		
		return $query;
	}
	function get_totalrow_product($is_private,$keyword,$catergory)
	{
		$this->db->from('product_description');
		$this->db->join('product', 'product.product_id = product_description.product_id');
		if($keyword!='')
		{
			$this->db->like("title",$keyword);
		}
		if($catergory!='')
		{
			$this->db->where("category_id",$catergory);
		}		
		$this->db->where('language_code',$this->config->item('default_langcode'));
		return $this->db->count_all_results();
	}
	
	function add_product($data)
	{
		$this->db->trans_start(); 
		
		$config['upload_path'] = $this->config->item('product_file_location');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= $this->config->item('max_image_size');
		$config['encrypt_name']	=TRUE;    // rename to random string
		
		$this->load->library('upload', $config);
		$thumb_images='';
		$full_images='';
		// upload multiple images
		if($_FILES['fullimage']['name'][0]!='')
		{
			$n=count($_FILES['fullimage']['name']);
		}
		else
		{
			$n=0;
		}
		if($n>0)
		{
			if($this->upload->do_multiple_upload($_FILES['fullimage']))//If it is a succesfull...
			{
			  $full_images= ",".implode(",", $this->upload->get_unique_file_names()).",";
			}
			else
			{
				return -1;
			}
		}
				
		// upload 1 images
		if($_FILES['userfile']['name'])
		{
			if ( $this->upload->do_upload())
			{	
					$datax=$this->upload->data();
					$thumb_images=$datax['file_name'];
			}
			else
			{
				return -1;
			}
		}
		
		//echo $full_images." ==  ".$datax['file_name'];
			$cate_arr=$data['articlecategory'];
			$product_category=',';
			foreach($cate_arr as $cate)
			{
				$product_category.=$cate.',';
			}
		//echo "<br>".$product_category;
			$this->db->set('category_id',$product_category);
			$this->db->set('thumb_image',$thumb_images);
			$this->db->set('big_image',$full_images);
			$this->db->set('name_id',$data['nameid']);
			$this->db->set('manufacturer_id',$data['manufacturercategory']);
			$this->db->set('status',$data['publish']);
			$this->db->set('price',$data['price']);
			$this->db->set('sort_order',$data['sorting']);
			$this->db->set('is_special',$data['special']);
			$this->db->set('new_product',$data['new_product']);
			$this->db->insert('product'); 
			$id=$this->db->insert_id();			

			$arr['seo'] =seo_url($data['title']); // load from helper
			$this->db->set('product_id',$id);
			$this->db->set('language_code',$this->config->item('default_langcode'));
			$this->db->set('name',$data['title']);
			$this->db->set('name_alias',$arr['seo']);
			$this->db->set('short_des',$data['introduction']);
			$this->db->set('description',$data['maincontent']);
			$this->db->insert('product_description');
			
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

	function update_product($data)
	{
		$this->db->trans_start(); 
		
		$config['upload_path'] = $this->config->item('product_file_location');
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= $this->config->item('max_image_size');
		$config['encrypt_name']	=TRUE;    // rename to random string
		
		$this->load->library('upload', $config);
		// upload multiple images
		if($_FILES['fullimage']['name'][0]!='')
		{
			$n=count($_FILES['fullimage']['name']);
		}
		else
		{
			$n=0;
		}
		if($n>0)
		{
			$num=$this->get_number_image_product($data['currentid']);
			$update_image_num= $this->config->item('max_number_of_image')-$num;
			if(isset($data['updateall']))
			{
				$update_image_num= '';
			}
			if($this->upload->do_multiple_upload($_FILES['fullimage'],$update_image_num))//If it is a succesfull...
			{
			  if(($num<1) || isset($data['updateall'])) // upload all images
			  {
			  	$full_images= ",".implode(",", $this->upload->get_unique_file_names()).",";
			  }
			  else // current images + update images
			  {
			  	$res=$this->get_image_product_detail($data['currentid']);
				$res=$res->result_array();
				$current_image=$res[0]['big_image'];
				$full_images= $current_image.implode(",", $this->upload->get_unique_file_names()).",";
			  }
			  $this->db->set('big_image',$full_images);
			}
			else
			{
				return -1;
			}
		}
				
		// upload 1 images
		if($_FILES['userfile']['name'])
		{
			if ( $this->upload->do_upload())
			{	
					$datax=$this->upload->data();
					$thumb_images=$datax['file_name'];
					$this->db->set('thumb_image',$thumb_images);
			}
			else
			{
				return -1;
			}
		}
		
		//echo $full_images." ===  ".$datax['file_name'];
			$cate_arr=$data['articlecategory'];
			$product_category=',';
			foreach($cate_arr as $cate)
			{
				$product_category.=$cate.',';
			}
		//echo "<br>".$product_category;
			$this->db->set('category_id',$product_category);
			
			
			$this->db->set('name_id',$data['nameid']);
			$this->db->set('manufacturer_id',$data['manufacturercategory']);
			$this->db->set('status',$data['publish']);
			$this->db->set('price',$data['price']);
			$this->db->set('sort_order',$data['sorting']);
			$this->db->set('is_special',$data['special']);
			$this->db->set('new_product',$data['new_product']);
			$this->db->where('product_id',$data['currentid']);
			$this->db->update('product'); 

			$arr['seo'] =seo_url($data['title']); // load from helper
			$this->db->set('language_code',$this->config->item('default_langcode'));
			$this->db->set('name',$data['title']);
			$this->db->set('name_alias',$arr['seo']);
			$this->db->set('short_des',$data['introduction']);
			$this->db->set('description',$data['maincontent']);
			$this->db->where('product_id',$data['currentid']);
			$this->db->update('product_description');
			
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
	function get_number_image_product($id) // Get quantity big image of a product
	{
		$this->db->select('product_id,big_image');
		$this->db->from('product');
		$this->db->where('product_id',$id);
		$query = $this->db->get();
		$result = $query->result_array();
		$images=$result[0]['big_image'];
		$arr=explode(",",$images);
		$num=count($arr)-2;
		if($num>0)
		{
			return $num;
		}
		else
		{
			return 0;
		}
	}
	
	function get_product_detail($id)
	{
		$this->db->select('*');
		$this->db->from('product_description');
		$this->db->join('product', 'product.product_id = product_description.product_id');
		$this->db->where('product.product_id',$id);
		$query = $this->db->get();		
		return $query;
	}
	function get_image_product_detail($id)
	{
		$this->db->select('product_id,big_image');
		$this->db->from('product');
		$this->db->where('product_id',$id);
		$query = $this->db->get();		
		return $query;
	}

	function delete_product($id)
	{
		$this->db->trans_start(); 
		$this->db->delete('article', array('id' => $id));
		$this->db->delete('comments', array('item_id' => $id, 'type' =>0));
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
	function publish_product($id,$status)
	{
		$this->db->trans_start();
		
		$this->db->set('status',!$status);
		$this->db->where('product_id',$id);
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
	
	function delete_product_image($id,$images)
	{
		$this->db->trans_start();
		
		$this->db->select('product_id,big_image');
		$this->db->from('product');
		$this->db->where('product_id',$id);
		$query = $this->db->get();
		$result = $query->result_array();
		$new=str_replace(','.$images,'',$result[0]['big_image']);

		$new=(strlen($new)>3)?$new:'';
		$this->db->set('big_image',$new);
		$this->db->where('product_id',$id);
		$this->db->update('product');
		
		$this->db->trans_complete();
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return $new;
		}
	}
}