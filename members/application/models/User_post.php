<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_post extends CI_Model {
	  
		public function __construct()
		{
		    parent::__construct();
		    $this->load->database();		   
		}
		//constructor end

		public function getName($user_id)
		{
			$this->db->select('name');
			$this->db->where('user_id',$user_id);
			$query = $this->db->get('users');			
			if($query->num_rows() > 0){
				$name_ary=$query->row();	
				return $name =ucwords($name_ary->name);
		        
		        }else{
		        	return false;
		           	        	 
		        }
		}
		// fetching the profile image 
		public function getProfileImage($user_id=NULL){
						
			$this->db->where("user_id", $user_id);
			$this->db->where("is_default",1);			
			$query_image=$this->db->get("wgp_user_images");
			if($query_image)
			{ 
				if($query_image->num_rows() > 0)
				   {
				       $row=$query_image->row();
					  
					   if($row->image_file==''){
							 return  $image_url='images/sports-football.png';
					   }else{
							 return $image_url=$row->image_file;
					   }

				   }else{
						
						return $image_url='images/sports-football.png';
				   }
			}else{

			   return $image_url='images/sports-football.png';
				   
			}
		}

		public function total_posts($user_id)
		{
			$friend_id_array = array();
			$friend_array = $this->getFriendShip($user_id);
			foreach ( $friend_array as $friend_row){
                    
                     array_push($friend_id_array, $friend_row->friend_id);

					}
			
			array_push($friend_id_array, $user_id);
			$friend_id_array=implode(',', $friend_id_array);
			
			$query = $this->db->query("SELECT *
										FROM `wgp_user_post`
										WHERE `parent_post` = '0' AND `poster_id` IN ($friend_id_array)										
										ORDER BY `post_id` DESC"
							         );
   			if(!$query){
			   return '<p>Currently there is no post in the list.</p>';
			}else{
				if($query->num_rows()==0)
				{
				  return '<p>Currently there is no post in the list.</p>';
				}else{
				  return $total_posts =$query->num_rows();
				}
		   }
			
		}
		
		public function getFriendShip($user_id){
			
			$this->db->select('friend_id');
			$this->db->where('user_id',$user_id);
			$this->db->where('status',1);
			$query = $this->db->get('wgp_user_friends');
			
				if($query->num_rows > 0){					
					return false;
				}else{					
					
					 	
					 return	$query->result();			
				}
		}
		
		public function fetch_posts($user_id,$group_no)
		{	
            $friend_id_array = array();
			$friend_array = $this->getFriendShip($user_id);
			foreach ( $friend_array as $friend_row){
                    
                     array_push($friend_id_array, $friend_row->friend_id);

					}
			
			array_push($friend_id_array, $user_id);
			$friend_id_array=implode(',', $friend_id_array);
			
			//print_r($friend_id_array);exit;					
            // Create connection
			$limit_start=$group_no-1;
			$start=$limit_start*10;
			$limit =10;
			
			$query = $this->db->query("SELECT *
										FROM `wgp_user_post`
										WHERE `parent_post` = '0' AND `poster_id` IN ($friend_id_array)										
										ORDER BY `post_id` DESC
										LIMIT  $start , $limit");
			//fetching 10 posts	
			
			if(!$query){
				 return '<p>Error getting state values from database</p>';
			}
			else {
				if($query->num_rows()==0){
					 return '<p>Currently there is no post in the list.</p>';
				}else{
			      
					$data="";					
					$post_ary = $query->result();

				foreach ($post_ary as $post) 
				{		
				    			
			       //fetching user details using his id				    			
					$user_id =	$post->poster_id;	
			        $user_name=$this->getName($post->poster_id);			        
			  		$image_url=$this->getProfileImage($post->poster_id);

					$post_value =	base64_decode($post->content);
                    $post_id =	$post->post_id;					 
				    $post_date = date("M d, Y h:i:A", strtotime($post->post_date));
					
				
				    $data.= '<div id="div_'.$post_id.'" class="uk-width-medium-player"><ul class="got_players_wall">
				        	 <li class="got-pl-left"><div class="sqil-profile">
							 <img width="25px" height="25px" alt="'.$user_name.' Profile Image" src="'.base_url().$image_url.'" class="img_thumb">
							 </div></li><li class="got-pl-right"><div class="all-dtls-sqil">
							  <span><a href="/">'.$user_name.'</a> <i>'.$post_date.'</i></span> 
							  <a class="icon_dlt icon_dlt_red" onclick="delete_post('.$post_id.')" id="delete_'.$post_id.'"><i class="material-icons tedo"></i></a>
							  <a class="icon_dlt icon_dlt_green" onclick="edit_post('.$post_id.')" id="edit_'.$post_id.'"><i class="material-icons tedo"></i></a>	
							  <div class="post_content" id="post_value_'.$post_id.'"><p>'.$post_value.'</p></div>';


					$this->db->where('user_id',$user_id);
					$this->db->where('parent_post',$post_id);	
					$this->db->order_by('post_id','ASC');
					$query_c =$this->db->get('wgp_user_post');
					if(!$query_c){
						$data .= '<p>Error getting state values from database</p>';
					}else if($query_c->num_rows()==0){
						$data.= '';
					}else{
						//ouput records
			        	$i = 0;
						if($query_c->num_rows()>3){
					   		$more=$query_c->num_rows()-3;
							$data.='<a href="/" class="dashbv-more">View '.($query_c->num_rows()-3).' more comments</a>';
						}
					
						$data.='<ul id="sub_comments_'.$post_id.'" class="all-mini-dtls">';
				    	$comment = $query_c->result();
				
						foreach ($comment as $key => $row) 
						{  
						     $comment_value =	base64_decode($row->content);
		                     $comment_id =	$row->post_id;					 
						     $comment_date =date("M d, Y h:i:A", strtotime($row->post_date));
							 $user_id =	$row->user_id;					 
							 $user_id_encoded=$user_id;
							 $poster_id = $row->poster_id;	
							
							//fetching user details using his id				
							$commenter_name = $this->getName($poster_id);
							// fetching the profile image 	
							$image_url = $this->getProfileImage($poster_id);		
					
					 						
							$data.='<li id="comment_'.$comment_id.'"><div class="sqil-profile-mini">
									<img width="25px" height="25px" src="'.base_url().$image_url.'" alt="'.$commenter_name.' singh profile pic">
								    </div><div class="all-dtls-sqil-mini"><span><a href="/">'.$commenter_name.'</a>
									<i>'.$comment_date.'</i></span>
											
							 <a class="icon_dlt icon_dlt_red" onclick="delete_comment('.$comment_id.')"><i class="material-icons tedo"></i></a>';
						 	if($poster_id==$user_id){					
							    $data.= '<a class="icon_dlt icon_dlt_green" onclick="edit_comment('.$comment_id.')"><i class="material-icons tedo"></i></a>';
						    }		
						    $data.='<div id="comment_value_'.$comment_id.'"><p>'.$comment_value.'</p></div></div>
								<input type="hidden" value="'.$user_id_encoded.'" id="commerter_user_id_'.$comment_id.'">
							</li>';
						}							
					   $data.= '</ul>';
			        }

							 

							$data.= '<ul class="post_cmnt_dashboard">
							  <li class="dshbrd-post-cmnt">
								<input type="text" placeholder="Write a comment" value="" id="comment_value_'.$post_id.'" name="comment_value">
								<input type="hidden" value="'.$user_id.'" id="post_user_id_'.$post_id.'" name="post_user_id">
								</li><li class="dshbrd-post-cmnt-right">
								<div style="display: none;" id="comment_loader_'.$post_id.'" class="comment_loader"><img alt="loading..." src="'.base_url().'images/loader.gif"></div>
								<input type="button" value="Post" onclick="add_comment('.$post_id.')" id="submit_comment_'.$post_id.'" name="submit_comment" style="display: block;">
							  </li>
							</ul>
							<span id="comment_error_'.$post_id.'" class="parsley-errors-list"></span>
							</div></li></ul></div>';
			   	 }
			   	}
			   	  return $data;
			  }
			

		}//fetch_posts function end 

		
		public function fetch_new_posts($user_id,$total_old_posts)
		{		
            $total_new_posts = $this->total_posts($user_id);
			$post_diff= $total_new_posts-$total_old_posts;
			
			$friend_id_array = array();
			$friend_array = $this->getFriendShip($user_id);
			foreach ( $friend_array as $friend_row){
                    
                     array_push($friend_id_array, $friend_row->friend_id);

					}
			
			array_push($friend_id_array, $user_id);
			$friend_id_array=implode(',', $friend_id_array);			
			$query = $this->db->query("SELECT *
										FROM `wgp_user_post`
										WHERE `parent_post` = '0' AND `poster_id` IN ($friend_id_array)										
										ORDER BY `post_id` DESC LIMIT 0, $post_diff"
							         );
			 if(!$query){
			 	 return '';
			 }
			 else if($query->num_rows()==0){
			 	return '<div id="total_posts" style="display: none;">'.$total_new_posts.'</div>';
			 }
			else
			{
			   
			        //ouput records
			        $i = 0;
					$data="";
					$data.='<div id="total_posts" style="display: none;">'.$total_new_posts.'</div>';				
					$post_ary = $query->result();

				foreach ($post_ary as $post) 
				{	
					 
				    //fetching user details using his id
				    $user_id =	$post->poster_id;					    			
			        $user_name=$this->getName($post->poster_id);	
			  		$image_url=$this->getProfileImage($post->poster_id);   
					
					 $post_value =	base64_decode($post->content);
                     $post_id =	$post->post_id;					 
				     $post_date =	date("M d, Y h:i:A", strtotime($post->post_date));
					 
					 
					 $data.= '<div id="div_'.$post_id.'" class="uk-width-medium-player">
				        <ul class="got_players_wall">
				        	
							<li class="got-pl-left">
				        		<div class="sqil-profile">
								 <img width="25px" height="25px" alt="'.$user_name.' Profile Image" src="'.base_url().$image_url.'" class="img_thumb">
								</div>
				        	</li>
							
				        	<li class="got-pl-right">
				        		<div class="all-dtls-sqil">
										<span><a href="/">'.$user_name.'</a> <i>'.$post_date.'</i></span> 
										<a class="icon_dlt icon_dlt_red" onclick="delete_post('.$post_id.')"><i class="material-icons tedo"></i></a>
										<a class="icon_dlt icon_dlt_green" onclick="edit_post('.$post_id.')"><i class="material-icons tedo"></i></a>	
										<div id="post_value_'.$post_id.'"><p>'.$post_value.'</p></div>';
				
			        $this->db->where('user_id',$user_id);
					$this->db->where('parent_post',$post_id);	
					$this->db->order_by('post_id','ASC');
					$query_c =$this->db->get('wgp_user_post');
					if(!$query_c){
						$data .= '<p>Error getting state values from database</p>';
					}else if($query_c->num_rows()==0){
						$data.= '<ul id="sub_comments_'.$post_id.'" class="all-mini-dtls"></ul>';
					}else{

						//ouput records
			        	$i = 0;
						if($query_c->num_rows()>3){
					   		$more=$query_c->num_rows()-3;
							$data.='<a href="/" class="dashbv-more">View '.($query_c->num_rows()-3).' more comments</a>';
						}
					
						$data.='<ul id="sub_comments_'.$post_id.'" class="all-mini-dtls">';
				    	$comment = $query_c->result();
				
						foreach ($comment as $row) 
						{ 
		
					 $comment_value =	base64_decode($row->content);
                     $comment_id =	$row->post_id;					 
				     $comment_date = date("M d, Y h:i:A", strtotime($row->post_date));
					 $user_id =	$row->user_id;					 
					 $user_id_encoded=$user_id;
					 $poster_id =	$row->poster_id;	
			
			        //fetching user details using his id				
					$commenter_name = $this->getName($poster_id);
					// fetching the profile image 	
					$image_url = $this->getProfileImage($poster_id);
					 						
					$data.= 	'<li id="comment_'.$comment_id.'">
								 <div class="sqil-profile-mini">
									<img width="25px" height="25px" src="'.base_url().$image_url.'" alt="'.$commenter_name.' singh profile pic">
								 </div>
								 <div class="all-dtls-sqil-mini">
								 <span>
								 			<a href="/">'.$commenter_name.'</a>
											 <i>'.$comment_date.'</i>
											 </span>
									
									<a class="icon_dlt icon_dlt_red" onclick="delete_comment('.$comment_id.')"><i class="material-icons tedo"></i></a>';
									if($poster_id==$user_id){					
									$data.= 	'<a class="icon_dlt icon_dlt_green" onclick="edit_comment('.$comment_id.')"><i class="material-icons tedo"></i></a>';
										}		
									$data.= 	'<div id="comment_value_'.$comment_id.'"><p>'.$comment_value.'</p></div>
													
									
									
								</div>
								<input type="hidden" value="'.$user_id_encoded.'" id="commerter_user_id_'.$comment_id.'">
						    </li>';
				}							
			          $data.= '</ul>';
			}	
							 

							 $data.= '<ul class="post_cmnt_dashboard">
											<li class="dshbrd-post-cmnt">
												<input type="text" placeholder="Write a comment" value="" id="comment_value_'.$post_id.'" name="comment_value">
												<input type="hidden" value="'.$user_id.'" id="post_user_id_'.$post_id.'" name="post_user_id">
											</li>
											<li class="dshbrd-post-cmnt-right">
											    <div style="display: none;" id="comment_loader_'.$post_id.'" class="comment_loader"><img alt="loading..." src="'.base_url().'images/loader.gif"></div>
												<input type="button" value="Post" onclick="add_comment('.$post_id.')" id="submit_comment_'.$post_id.'" name="submit_comment" style="display: block;">
											</li>
										</ul>
										<span id="comment_error_'.$post_id.'" class="parsley-errors-list"></span>
								</div>
				        	</li>
				        </ul>    
			        </div>';
					
				   $i++;
			   }
			   
			   
			  return $data;
			  }

		}//fetch_new_posts function end 
		
		public function add_parent_post($Data)
		{		
			$this->db->set('post_date', 'NOW()', FALSE);
			$result=$this->db->insert('wgp_user_post', $Data);
			if($result)
			{
			 $parent_post= $this->db->insert_id();
			 return $parent_post;
			}
			else
			{
			 return false;
			}

		}//add_parent_post function end 

	
        public function post_master($user_id,$post_id)
		{		
			$this->db->select('post_id');
			$this->db->from('wgp_user_post');
			$this->db->where('post_id', $post_id );
			$this->db->where('user_id', $user_id );
			$this->db->where('poster_id', $user_id );
			$query = $this->db->get();			
			if($query)
			{
			 	if ( $query->num_rows() ==1 ){
					return true;
				}
			}else{
			 	return false;
			}

		}//add_parent_post function end 
		
		public function delete_parent_post($post_id)
		{		

			$this->db->where('post_id', $post_id);
            $this->db->delete('wgp_user_post'); 
			return true;
		}//delete_parent_post function end 
        
		public function edit_parent_post($post_text_encoded,$post_id)
		{		

			$this->db->where('post_id', $post_id);            
            $this->db->update('wgp_user_post', array('content' => $post_text_encoded));
         	return true;
		}//edit_parent_post function end 
      
	    public function add_comment($Data)
		{		
			$this->db->set('post_date', 'NOW()', FALSE);
			$result=$this->db->insert('wgp_user_post', $Data);
			if($result){
			 $comment_id= $this->db->insert_id();
			 return $comment_id;
			}else{
			    return false;
			}

		}//add_parent_post function end 
		
		 public function comment_master($post_user_id,$post_commenter_id ,$comment_id)
		{		

			$this->db->select('post_id');
			$this->db->from('wgp_user_post');
			$this->db->where('post_id', $comment_id );
			$this->db->where('user_id', $user_id );
			$this->db->where('poster_id', $post_commenter_id );
			$query = $this->db->get();
			
			if($query)
			{
			 if ( $query->num_rows() ==1 )
				{
					return true;
				}
				 return false;
			}
			else
			{
			 return false;
			}

		}//comment_master function end 
		 
		 
		public function comment_edit_master($post_commenter_id ,$comment_id)
		{		

			$this->db->select('post_id');
			$this->db->from('wgp_user_post');
			$this->db->where('post_id', $comment_id );
			$this->db->where('poster_id', $post_commenter_id );
			$query = $this->db->get();
			
			if($query)
			{
			 if ( $query->num_rows() ==1 )
				{
					return true;
				}
				 return false;
			}
			else
			{
			 return false;
			}

		}//comment_master function end 
		
		public function delete_comment($comment_id)
		{		

			$this->db->where('post_id', $comment_id);
            $this->db->delete('wgp_user_post'); 
			return true;
		}//delete_parent_post function end 
		
		public function edit_comment($comment_text_encoded,$comment_id)
		{		

			$this->db->where('post_id', $comment_id);            
            $this->db->update('wgp_user_post', array('content' => $comment_text_encoded));
         	return true;
		}//edit_parent_post function end 
}