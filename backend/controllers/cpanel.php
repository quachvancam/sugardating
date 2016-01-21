<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cpanel extends CI_Controller {

	function __construct()
    {
        parent::__construct();
    }
	
	function index()
	{
        $data['title'] = "Administrator Cpanel | Sugar Dating";
        $data['content'] = 'main';
		$this->load->view('template',$data,'');
	}
	function changepassword()
	{
		$data['content']=$this->load->view('changepassword','',true);
		$this->load->view('template',$data);
	}
	function get_type()
	{
		$result_human_organization=$this->user_model->get_json();
		if($result_human_organization->num_rows()>0)
		{
			
			foreach($result_human_organization->result_array() as $mytype)
			{
				echo $mytype['name'];	
			}
		}
	}
/*========================================= SETTING ===========================================*/	
	function setting($tab=null)
	{
		if($tab=="globalconfig")
		{
			$result_profile=$this->user_model->get_config();
			$_all_setting=array();
			if($result_profile->num_rows()>0)
			{
				$_all_setting['setting']=$result_profile->result_array();
			}
						
			$data['content']=$this->load->view('globalconfig',$_all_setting,true);
		}
		else
		{
			$result_profile=$this->user_model->get_user_profile(1);
			$_all_setting=array();
			if($result_profile->num_rows()>0)
			{
				$_all_setting['setting']=$result_profile->result_array();
			}
						
			$data['content']=$this->load->view('adminprofile',$_all_setting,true);
		}
		$this->load->view('template',$data);
	}
	function update_config()
	{
		if($_POST['type']=='config')	
		{
			$data['website_name']=$_POST['website_name'];
			$data['description']=$_POST['description'];
			$data['keyword']=$_POST['keyword'];
			$this->db->where('id',1);
			$result=$this->db->update('website_info',$data);
			if ($result) 
			{
				$this->session->set_flashdata('message', $this->show_result_notification(1));
			} 
			else 
			{
				$this->session->set_flashdata('message', $this->show_result_notification(2));
			}
			redirect("cpanel/setting/globalconfig/");
		}
		else
		{
			$data['fullname']=$_POST['fullname'];
			$data['email']=$_POST['email'];
			if(($_POST['newpass']!='') && ($_POST['newpass']==$_POST['confirmpass']))
			{
				$data['password']=md5($_POST['newpass']);
			}
			$this->db->where('ua_user_id',1);
			$result=$this->db->update('ua_users',$data);
			if ($result) 
			{
				$this->session->set_flashdata('message', $this->show_result_notification(1));
			} 
			else 
			{
				$this->session->set_flashdata('message', $this->show_result_notification(2));
			}
			redirect("cpanel/setting/adminprofile/");
		}
	}
/*========================================= END SETTING =======================================*/
/*========================================= TESTIMONIAL =======================================*/
	function testimonial()
	{
		if($_POST)
		{
			$result_all_testimonial=$this->article_model->get_search($_POST,'testimonial');	
			
			$_all_testimonial=array();
			if($result_all_testimonial->num_rows()>0)
			{
				$_all_testimonial=$result_all_testimonial->result_array();
			}
			$_all_testimonialdata['testimonial']=$_all_testimonial;				
			$_all_testimonialdata['keyword']=$_POST['keyword'];
		}
		else
		{
			$config['base_url'] = base_url().index_page().'/cpanel/testimonial/';
			$config['per_page'] = $this->config->item('item_per_page');
			$config['uri_segment'] = 3; 
			$config['total_rows'] =$this->article_model->get_totalrow_testiminial();
			$this->pagination->initialize($config);
			$result_all_testimonial=$this->article_model->get_testimonial($config['per_page'],$this->uri->segment(3));	
			
			$_all_testimonial=array();
			if($result_all_testimonial->num_rows()>0)
			{
				$_all_testimonial=$result_all_testimonial->result_array();
			}
			$_all_testimonialdata['testimonial']=$_all_testimonial;				
			$_all_testimonialdata['all_link']=$this->pagination->create_links();
		}
		$data['content']=$this->load->view('testimonial',$_all_testimonialdata,true);
		$this->load->view('template',$data);

	}
	function edit_testimonial($id='')
	{
		if($id!='')
		{
			
			$result_testimonial=$this->article_model->get_testimonial_detail($id);
			$_all_testimonial=array();
			if($result_testimonial->num_rows()>0)
			{
				$_arr=$result_testimonial->result_array();
				$_all_testimonial['testimonial']=array(
				'id' =>$_arr[0]['id'],
				'title' =>$_arr[0]['title'],
				'image' =>$_arr[0]['image'],
				'website' =>$_arr[0]['website'],
				'author' =>$_arr[0]['author'],
				'content' =>$_arr[0]['content'],
				'sorting' =>$_arr[0]['sorting']
				);
			}
			$_all_testimonial['header']='Edit testimonial';
						
			
		}
		else
		{
			$_all_testimonial['testimonial']=array(
				'id' =>'',
				'title' =>'',
				'image' =>'',
				'website' =>'',
				'author' =>'',
				'content' =>'',
				'sorting' =>''
			);
			$_all_testimonial['header']='Add new testimonial';
		}
		$data['content']=$this->load->view('edit_testimonial',$_all_testimonial,true);
		$this->load->view('template',$data);
	}
	function add_testimonial()
	{
		$action=$this->article_model->add_testimonial($_POST);
		if ($action)
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/testimonial/");
	}
	function delete_testimonial($id)
	{
		$this->db->where('id',$id);
		$action=$this->db->delete('testimonials');
			
		if ($action)
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/testimonial/");
	}
/*========================================= END TESTIMONIAL =======================================*/	
/*========================================= SLIDESHOW =======================================*/
	function slideshow()
	{
		  	$result_all_slideshow=$this->article_model->get_slideshow();	
			$_all_slideshow=array();
			if($result_all_slideshow->num_rows()>0)
			{
				$_all_slideshow=$result_all_slideshow->result_array();
			}
			$_all_slideshowdata['slideshow']=$_all_slideshow;				
			$data['content']=$this->load->view('slideshow',$_all_slideshowdata,true);
		  $this->load->view('template',$data);

	}
	function edit_slideshow($id='')
	{
		if($id!='')
		{
			
			$result_slideshow=$this->article_model->get_slideshow($id);
			$_all_slideshow=array();
			if($result_slideshow->num_rows()>0)
			{
				$_arr=$result_slideshow->result_array();
				$_all_slideshow['slideshow']=array(
				'id' =>$_arr[0]['id'],
				'title' =>$_arr[0]['title'],
				'image' =>$_arr[0]['image'],
				'content' =>$_arr[0]['content'],
				'sorting' =>$_arr[0]['sorting']
				);
			}
			$_all_slideshow['header']='Edit slideshow';
						
			
		}
		else
		{
			$_all_slideshow['slideshow']=array(
				'id' =>'',
				'title' =>'',
				'image' =>'',
				'content' =>'',
				'sorting' =>''
			);
			$_all_slideshow['header']='Add new slideshow';
		}
		$data['content']=$this->load->view('edit_slideshow',$_all_slideshow,true);
		$this->load->view('template',$data);
	}
	function add_slideshow()
	{
		$action=$this->article_model->add_slideshow($_POST);
		if ($action)
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/slideshow/");
	}
	function delete_slideshow($id)
	{
		$this->db->where('id',$id);
		$action=$this->db->delete('slideshow');
			
		if ($action)
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/slideshow/");
	}
/*========================================= END SLIDESHOW =======================================*/	
/*========================================= ARTICLE ===========================================*/	
	function article()
	{
		if($_POST) // search
		{
				
				$result_all_article=$this->article_model->get_search($_POST,'article');	
				
				$_all_article=array();
				if($result_all_article->num_rows()>0)
				{
					$_all_article=$result_all_article->result_array();
				}
				$_all_articledata['article']=$_all_article;				
				$_all_articledata['keyword']=$_POST['keyword'];
		}
		else	// show list
		{
				$config['base_url'] = base_url().index_page().'/cpanel/article/';
				$config['per_page'] = $this->config->item('item_per_page');
				$config['uri_segment'] = 3; 
				
				$config['total_rows'] =$this->article_model->get_totalrow_article();
				$this->pagination->initialize($config);
				$result_all_article=$this->article_model->get_all_article($config['per_page'],$this->uri->segment(3));	
				$_all_article=array();
				if($result_all_article->num_rows()>0)
				{
					$_all_article=$result_all_article->result_array();
				}
				$_all_articledata['article']=$_all_article;				
				$_all_articledata['all_link']=$this->pagination->create_links();
				
		}
		$data['content']=$this->load->view('article',$_all_articledata,true);
		$this->load->view('template',$data);
	}
	
	function add_article()
	{

		$action=0;
		if($this->input->post('id')!='')
		{
			$action=$this->article_model->update_article($_POST);
		}
		else
		{
			$action=$this->article_model->add_article($_POST);
		}
		if ($action)
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/article/");
	}
	
	function edit_article($id='')
	{
		if($id!='')
		{
			
			$result_article=$this->article_model->get_article($id);
			$_all_article=array();
			if($result_article->num_rows()>0)
			{
				$_arr=$result_article->result_array();
				$_all_article['article']=array(
				'id' =>$_arr[0]['id'],
				'title' =>$_arr[0]['title'],
				'small_img' =>$_arr[0]['small_img'],
				'content' =>$_arr[0]['content']
				);
			}
			$_all_article['header']='Edit article';
						
			
		}
		else
		{
			$_all_article['article']=array(
				'id' =>'',
				'title' =>'',
				'small_img' =>'',
				'content' =>''
			);
			$_all_article['header']='Add new article';
		}
		$data['content']=$this->load->view('edit_article',$_all_article,true);
		$this->load->view('template',$data);
	}
	
	function delete_article($id)
	{
		$this->is_login(); // check before delete
		if ($this->article_model->delete_article($id))
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/article/");
	}
	
/*========================================= END ARTICLE ===========================================*/	
/*========================================= Portfolio ===========================================*/	
	function portfolio()
	{
		if($_POST) // search
		{
				
				$result_all_portfolio=$this->article_model->get_search($_POST,'portfolio');	
				
				$_all_portfolio=array();
				if($result_all_portfolio->num_rows()>0)
				{
					$_all_portfolio=$result_all_portfolio->result_array();
				}
				$_all_portfoliodata['portfolio']=$_all_portfolio;				
				$_all_portfoliodata['keyword']=$_POST['keyword'];
		}
		else	// show list
		{
				$config['base_url'] = base_url().index_page().'/cpanel/portfolio/';
				$config['per_page'] = $this->config->item('item_per_page');
				$config['uri_segment'] = 3; 
				
				$config['total_rows'] =$this->article_model->get_totalrow_portfolio();
				$this->pagination->initialize($config);
				$result_all_portfolio=$this->article_model->get_all_portfolio($config['per_page'],$this->uri->segment(3));	
				$_all_portfolio=array();
				if($result_all_portfolio->num_rows()>0)
				{
					$_all_portfolio=$result_all_portfolio->result_array();
				}
				$_all_portfoliodata['portfolio']=$_all_portfolio;				
				$_all_portfoliodata['all_link']=$this->pagination->create_links();
				
		}
			$categories=array();	
			$result_categories=$this->general_model->get_all_category(); 
			if($result_categories->num_rows()>0)
				{
					$categories=$result_categories->result_array();
				}
			$_all_portfoliodata['category']=$categories;
		$data['content']=$this->load->view('portfolio',$_all_portfoliodata,true);
		$this->load->view('template',$data);
	}
	
	function add_portfolio()
	{

		/*for($i=1;$i<6;$i++)
		{
			var_dump($_FILES['userfile'.$i]['name']);
			
			var_dump($_FILES['thumb'.$i]['name']);
			if(isset($_POST['default'.$i]))
			{
				echo $_POST['default'.$i]."<br>";
			}
			echo "<br>";
		}*/
		//die;
		/*var_dump($_POST['default']);
		die;*/
		$action=0;
		if($this->input->post('id')!='')
		{
			$action=$this->article_model->update_portfolio($_POST);
		}
		else
		{
			$action=$this->article_model->add_portfolio($_POST);
		}
		if ($action)
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/portfolio/");
	}
	
	function edit_portfolio($id='')
	{
		if($id!='')
		{
			
			$result_portfolio=$this->article_model->get_portfolio($id);
			$_all_portfolio=array();
			if($result_portfolio->num_rows()>0)
			{
				$_arr=$result_portfolio->result_array();
				$_all_portfolio['portfolio']=array(
				'id' =>$_arr[0]['id'],
				'category_id'=>$_arr[0]['category_id'],
				'title' =>$_arr[0]['title'],
				'company_name' =>$_arr[0]['company_name'],
				'content' =>$_arr[0]['content']
				);
			}
			$_all_portfolio['header']='Edit portfolio';
			
			$result_media=$this->article_model->get_media($id);
			$_all_media=array();
			$n=0;
			$j=1;
			if($result_media->num_rows()>0)
			{
				$_arr=$result_media->result_array();
				$n=count($_arr);
				$i=0;
				for($j=1;$j<=$n;$j++)
				{
					
					$_all_portfolio['media'][$j]=array(
					'id' =>$_arr[$i]['id'],
					'portfolio_id'=>$_arr[$i]['portfolio_id'],
					'media_file' =>$_arr[$i]['media_file'],
					'thumbnail' =>$_arr[$i]['thumbnail'],
					'default' =>$_arr[$i]['default'],
					'no' =>$_arr[$i]['no']
					);
					$i++;
				}
				//echo $j;
				
				//var_dump($_all_portfolio['media']);
			}
			if($n<5)
				{
					for($m=$j;$m<=5;$m++)
					{
						$_all_portfolio['media'][$m]=array(
						'id' =>'',
						'portfolio_id'=>'',
						'media_file' =>'',
						'thumbnail' =>'',
						'default' =>'',
						'no' =>$m
						);
					}
				}
			
		}
		else
		{
			$_all_portfolio['portfolio']=array(
				'id' =>'',
				'category_id'=>'',
				'title' =>'',
				'company_name' =>'',
				'content' =>''
			);
			$_all_portfolio['header']='Add new portfolio';
			for($m=1;$m<6;$m++)
					{
						$_all_portfolio['media'][$m]=array(
						'id' =>'',
						'portfolio_id'=>'',
						'media_file' =>'',
						'thumbnail' =>'',
						'default' =>'',
						'no' =>$m
						);
					}
		}
		//var_dump($_all_portfolio['media']);
		$categories=array();	
			$result_categories=$this->general_model->get_all_category(); 
			if($result_categories->num_rows()>0)
				{
					$categories=$result_categories->result_array();
				}
		$_all_portfolio['category']=$categories;
		$data['content']=$this->load->view('edit_portfolio',$_all_portfolio,true);
		$this->load->view('template',$data);
	}
	
	function delete_portfolio($id)
	{
		$this->is_login(); // check before delete
		if ($this->article_model->delete_portfolio($id))
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/portfolio/");
	}
	
/*========================================= END portfolio ===========================================*/	

/*========================================= VIDEO ===========================================*/	
	function video()
	{
		if($_POST) // search
		{
				
				$result_all_video=$this->article_model->get_search($_POST,'video');	
				
				$_all_video=array();
				if($result_all_video->num_rows()>0)
				{
					$_all_video=$result_all_video->result_array();
				}
				$_all_videodata['video']=$_all_video;				
				$_all_videodata['keyword']=$_POST['keyword'];
		}
		else	// show list
		{
				$config['base_url'] = base_url().index_page().'/cpanel/video/';
				$config['per_page'] = $this->config->item('item_per_page');
				$config['uri_segment'] = 3; 
				
				$config['total_rows'] =$this->article_model->get_totalrow_video();
				$this->pagination->initialize($config);
				$result_all_video=$this->article_model->get_all_video($config['per_page'],$this->uri->segment(3));	
				$_all_video=array();
				if($result_all_video->num_rows()>0)
				{
					$_all_video=$result_all_video->result_array();
				}
				$_all_videodata['video']=$_all_video;				
				$_all_videodata['all_link']=$this->pagination->create_links();
				
		}
		$data['content']=$this->load->view('video',$_all_videodata,true);
		$this->load->view('template',$data);
	}
	
	function add_video()
	{

		$action=0;
		if($this->input->post('id')!='')
		{
			$action=$this->article_model->update_video($_POST);
		}
		else
		{
			$action=$this->article_model->add_video($_POST);
		}
		if ($action)
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/video/");
	}
	
	function edit_video($id='')
	{
		if($id!='')
		{
			
			$result_video=$this->article_model->get_video($id);
			$_all_video=array();
			if($result_video->num_rows()>0)
			{
				$_arr=$result_video->result_array();
				$_all_video['video']=array(
				'id' =>$_arr[0]['id'],
				'author'=>$_arr[0]['author'],
				'title' =>$_arr[0]['title'],
				'videocode' =>$_arr[0]['videocode'],
				'description' =>$_arr[0]['description']
				);
			}
			$_all_video['header']='Edit video';
		}
		else
		{
			$_all_video['video']=array(
				'id' =>'',
				'author'=>'',
				'title' =>'',
				'videocode' =>'',
				'description' =>''
			);
			$_all_video['header']='Add new video';
		}

		$data['content']=$this->load->view('edit_video',$_all_video,true);
		$this->load->view('template',$data);
	}
	
	function delete_video($id)
	{
		$this->is_login(); // check before delete
		if ($this->article_model->delete_video($id))
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/video/");
	}
	
/*========================================= END VIDEO ===========================================*/	

/*========================================= CATEGORY ===========================================*/
	function section($id='')
	{
		if($id!='')
		  {
			$result_all_article=$this->general_model->get_all_category($id);	
			$_all_article=array();
			if($result_all_article->num_rows()>0)
			{
				$_all_article=$result_all_article->result_array();
			}
			$_all_articledata['section']=$_all_article;				
			$data['content']=$this->load->view('section_edit',$_all_articledata,true);

		  }
		  else
		  {
			$categories=array();	
			$result_categories=$this->general_model->get_all_category(); 
			if($result_categories->num_rows()>0)
				{
					$categories=$result_categories->result_array();
				}
			$_categorydata['category']=$categories;
			$data['content']=$this->load->view('section',$_categorydata,true);
		  }
		$this->load->view('template',$data);
	}	
	function section_detail($id='')
	{
		$config['base_url'] = base_url().index_page().'/cpanel/section_detail/'.$id."/";
			$config['per_page'] = $this->config->item('item_per_page');
			$config['uri_segment'] = 4; 
			
			$config['total_rows'] =$this->article_model->get_totalrow_portfolio($id);
			$this->pagination->initialize($config);
			$result_all_portfolio=$this->article_model->section_detail($this->uri->segment(3),$config['per_page'],$this->uri->segment(4));	
			$_all_portfolio=array();
			if($result_all_portfolio->num_rows()>0)
			{
				$_all_portfolio=$result_all_portfolio->result_array();
			}
			$_all_portfoliodata['portfolio']=$_all_portfolio;				
			$_all_portfoliodata['all_link']=$this->pagination->create_links();				
			$categories=array();	
			$result_categories=$this->general_model->get_all_category(); 
			if($result_categories->num_rows()>0)
				{
					$categories=$result_categories->result_array();
				}
		$_all_portfoliodata['category']=$categories;
		$data['content']=$this->load->view('portfolio',$_all_portfoliodata,true);
		$this->load->view('template',$data);
	}
	function get_category_item()
	{
		$result=$this->general_model->get_category_item($this->input->post('id'));
		if($result->num_rows()>0)
		{
			
			echo json_encode($result->result_array());
		}
	}
	function publish_category()
	{
		$link=base_url()."assets/images/backend/";
		$result=$this->general_model->publish_category($this->input->post('id'),$this->input->post('current'));
		if($result)
		{
			echo $this->input->post('current')==0?"<img  onclick='publish_it(".$this->input->post('id').",1)' src='".$link."publish_y.png'>":"<img  onclick='publish_it(".$this->input->post('id').",0)'  src='".$link."publish_x.png'>";
		}
	}
	function update_section()
	{
			$action=$this->general_model->update_category($_POST);
		if ($action)
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/section/");

	}
	function delete_category($id)
	{
		$this->is_login(); // check before delete
		if ($this->general_model->delete_article_category($id))
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/article/article_category/");
	}
	
	function delete_product_category($id)
	{
		$this->is_login(); // check before delete
		if ($this->general_model->delete_product_category($id))
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/category_manager/product_category/");
	}
	
/*========================================= END CATEGORY ===========================================*/
	
/*================================== SHOW ACTION RESULT ====================================*/

	function show_result_notification($info)
	{
		if($info==1) // Success
		{
			return  '<div class="message success closeable"><p><strong>Success!</strong> in action</p></div>';	
		}
		else if($info==2) // Error
		{
			return  '<div class="message error closeable"><p><strong>Error!</strong> found, please try again</p></div>';	
		}
		else  // Attention
		{
			return  "";	
		}
	}
/*================================== END ACTION RESULT ====================================*/

/*====================================INFORMATIONS MANAGER=================================*/

	function information($id=null)
	{
		  if($id!='')
		  {
			$result_all_article=$this->general_model->get_information_general($id);	
			$_all_article=array();
			if($result_all_article->num_rows()>0)
			{
				$_all_article=$result_all_article->result_array();
			}
			$_all_articledata['information']=$_all_article;				
			$data['content']=$this->load->view('information_edit',$_all_articledata,true);

		  }
		  else
		  {
		  	$result_all_article=$this->general_model->get_information_general();	
			$_all_article=array();
			if($result_all_article->num_rows()>0)
			{
				$_all_article=$result_all_article->result_array();
			}
			$_all_articledata['information']=$_all_article;				
			$data['content']=$this->load->view('information',$_all_articledata,true);

		  }
		  $this->load->view('template',$data);

	}
	function update_information()
	{
		$this->is_login(); // check before delete
		$result=$this->general_model->update_information_general($_POST);
		if ($result) 
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));
		} 
		else 
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		
		redirect("cpanel/information/");
	}
/*================================END INFORMATIONS MANAGER=================================*/
	function delete_category_description($id)
	{
		$this->is_login(); 
		if ($this->article_model->delete_category_description($id))
		{
			$this->session->set_flashdata('message', '<div id="flashmessage">'.$this->lang->line('action_success').'</div>');	    	
		}
		else
		{
			$this->session->set_flashdata('message', '<div id="flashmessage">'.$this->lang->line('action_error').'</div>');
		}
			redirect("/adminpage/cpanel/category_manager/");		

	}	
//================ COMMENT ======================//

	function get_comment_detail()
	{
		$result=$this->general_model->get_comment_detail($this->input->post('id'),$this->input->post('type'));
		if($result->num_rows()>0)
		{
			$m=$result->result_array();
			$m[0]['thedate']= myfull_int_date($m[0]['thedate']);
			echo json_encode($m);
		}
	}
	function delete_comment($id,$type)
	{
		$this->is_login(); // check before delete
		if ($this->general_model->delete_comment($id,$type))
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/article/article_comment/");
	}
	function update_comment()
	{
		$this->is_login(); // check before delete
		if ($this->general_model->update_comment($_POST,0))
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/article/article_comment/");
	}
//================ END COMMENT ======================//

//================ PRODUCT MANAGER ======================//

	function product($tab=null,$pagenum=null)
	{
		if ($tab=='manufacture')
		{
			$_categorydata['manufacture']=array();	
			$categories=$this->general_model->get_all_manufacture(); 
			if($categories->num_rows()>0)
			{
				$_categorydata['manufacture']=$categories->result_array();
			}
			//$_categorydata['manufacture']=$categories;
			$data['content']=$this->load->view('manufacture',$_categorydata,true);
			$this->load->view('template',$data);
		
		}
		else
		{
			$config['base_url'] = base_url().index_page().'/cpanel/product/list_product/';
			$config['per_page'] = 5;//$this->config->item('item_per_page');
			$config['uri_segment'] = 4; 
			
			if(!empty($_POST))
			{
				//var_dump($_POST);
				$config['total_rows'] =$this->product_model->get_totalrow_product('',$_POST['keyword'],$_POST['article_category']);
				$this->pagination->initialize($config);

				$result_all_product=$this->product_model->get_all_product('',$_POST['keyword'],$_POST['article_category'],$config['per_page'],$this->uri->segment(4));
			
			
			}
			else
			{
				$config['total_rows'] =$this->product_model->get_totalrow_product('','','');
				$this->pagination->initialize($config);
				$result_all_product=$this->product_model->get_all_product('','','',$config['per_page'],$this->uri->segment(4));	

			
			}
			
			$_all_product=array();
			if($result_all_product->num_rows()>0)
			{
				$_all_product=$result_all_product->result_array();
			}
			$_all_productdata['all_product']=$_all_product;				
			$categories=$this->general_model->get_all_category(1,0,1); // Product: 1 === Article: 2; ROOT 0; Puplish 1
			$_all_productdata['categories']=$categories;
			$_all_productdata['selected_catalog']=1;
			
			$manufacturer=$this->general_model->get_all_manufacture('',1);
			$_all_productdata['manufacturer']='';
			if($manufacturer->num_rows()>0)
			{
				$_all_productdata['manufacturer']=$manufacturer->result_array();
			}
			
			
			$_all_productdata['all_link']=$this->pagination->create_links();
			$data['content']=$this->load->view('product',$_all_productdata,true);
			$this->load->view('template',$data);
		}
	
	
	}

	function add_product()
	{

		$action=0;
		if($this->input->post('component')=='update')
		{
			$action=$this->product_model->update_product($_POST);
			
		}
		else
		{
			//var_dump($_FILES['fullimage']['name'][0]);
			//for ($i=0;$i<count($_FILES['fullimage']['name']); $i++)
			//echo $_FILES['fullimage']['name'][$i]."/";  
			$action=$this->product_model->add_product($_POST);
		}
		if ($action)
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/product/list_product/");
	}
	
	function get_product_detail()
	{
		$result_product_detail=$this->product_model->get_product_detail($this->input->post('id'));
		if($result_product_detail->num_rows()>0)
		{
			
			echo json_encode($result_product_detail->result_array());
		}
	}
	function show_image_product($id)
	{
		$_categorydata['image_product']=array();	
		$categories=$this->product_model->get_image_product_detail($id); // get from ROOT:0
		if($categories->num_rows()>0)
			{
				$_all_product=$categories->result_array();
			}
		$_categorydata['image_product']=$_all_product;
		$data['content']=$this->load->view('image_product',$_categorydata);
	}

	function get_manufacturer_item()
	{
		$result=$this->general_model->get_all_manufacture($this->input->post('id'));
		if($result->num_rows()>0)
		{
			$m=$result->result_array();
			echo json_encode($m);
		}
	}
	function add_manufacturer()
	{
		$action=0;
		if($this->input->post('component')=='update')
		{
			$action=$this->general_model->update_manufacturer($_POST);
		}
		else
		{
			$action=$this->general_model->add_manufacturer($_POST);
		}
		if ($action)
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/product/manufacture/");

	}
	function publish_manufacturer()
	{
		$link=base_url()."assets/images/backend/";
		$result=$this->general_model->publish_manufacturer($this->input->post('id'),$this->input->post('current'));
		if($result)
		{
			echo $this->input->post('current')==0?"<img  onclick='publish_it(".$this->input->post('id').",1)' src='".$link."publish_y.png'>":"<img  onclick='publish_it(".$this->input->post('id').",0)'  src='".$link."publish_x.png'>";
		}
	}
	function delete_manufacturer($id)
	{
		$this->is_login(); // check before delete
		if ($this->general_model->delete_manufacturer($id))
		{
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/product/manufacture/");
	}
	
	function delete_product_image()
	{
		//echo $this->input->post('delete_img');
		$result=$this->product_model->delete_product_image($this->input->post('id'),$this->input->post('delete_img'));
		//echo $result;
		if (strlen($result)>3)
		{
			$arr=explode(",",$result);
			echo count($arr)-2;
		}
		else
		{
			echo 0;
		}
	}
	
	function publish_product()
	{
		$link=base_url()."assets/images/backend/";
		$result=$this->product_model->publish_product($this->input->post('id'),$this->input->post('current'));
		if($result)
		{
			echo $this->input->post('current')==0?"<img  onclick='publish_it(".$this->input->post('id').",1)' src='".$link."publish_y.png'>":"<img  onclick='publish_it(".$this->input->post('id').",0)'  src='".$link."publish_x.png'>";
		}
	}
//================ END PRODUCT ======================//



	
	function friend_link()
	{
		$data['icon']="icon-48-plugin.png";
		$data['title']="Link Website manager";
		$result_friend_link=$this->article_model->get_friend_link();
		$friend_link=array();
		if($result_friend_link->num_rows()>0)
		{
			$friend_link=$result_friend_link->result_array();
		}
		$_friend_link_data['friend_link']=$friend_link;
		
		$data['content']=$this->load->view('friend_link',$_friend_link_data,true);
		$this->load->view('template',$data);
	}
	function delete_link($id)
	{
		if ($this->article_model->delete_link($id))
		{
			$this->session->set_flashdata('message', '<div id="flashmessage">'.$this->lang->line('action_success').'</div>');	    	
			redirect("adminpage/cpanel/friend_link/");
		}
		else
		{
			$this->session->set_flashdata('message', '<div id="flashmessage">'.$this->lang->line('action_error').'</div>');
			redirect("/adminpage/cpanel/friend_link/");
		}

	}	
	
	function sendmail_delete_cv()
	{
		include "./backend/globalconfig.php";
		//echo $email; // Admin email
		
		if ($this->article_model->delete_cv($_POST,$email))
		{
			$this->session->set_flashdata('message', '<div id="flashmessage">'.$this->lang->line('action_success').'</div>');	    	
			redirect("adminpage/cpanel/cv_manager");
		}
		else
		{
			$this->session->set_flashdata('message', '<div id="flashmessage">'.$this->lang->line('action_error').'</div>');
			redirect("/adminpage/cpanel/cv_manager/");
		}
	}
/*============= Action require LOGIN ==============*/
	function is_login()
	{
		if ($this->session->userdata('logged_in_status') == FALSE)
		{
			redirect('/admin/');
		}
	}	
/*==================================================*/

/**************** CONFIG *****************/
	function update_admin_account()
	{
		$this->is_login(); // check before delete
		if ($this->general_model->update_admin_account($_POST))
		{
			if($_POST['newpassword']!='')
			{
				$this->session->set_flashdata('changepass', '1');
				$this->session->unset_userdata('logged_in_status');
	    		redirect('/admin/');
			}
			$this->session->set_flashdata('message', $this->show_result_notification(1));	    	
		}
		else
		{
			$this->session->set_flashdata('message', $this->show_result_notification(2));
		}
		redirect("cpanel/setting/adminprofile/");
	}

}
