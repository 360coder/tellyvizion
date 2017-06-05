<?php

//use \Redirect as Redirect;
//use \HelloVideo\User as User;
set_error_handler(null);
set_exception_handler(null);
//include(app_path() . '/lib/Facebook/autoload.php');
class ThemeSocialController extends \BaseController {

die('aaaaaa');
public function __construct()
	{
		$this->middleware('secure');
	}
	public $table = FACEBOOK_TB;

	public function index(){

		$page_size      = 10;
        $page_num       = (get('p')) ? get('p') : 1;
        $total_row      = $this->model->getList(-1,-1);
        $start_row      = (get('p'))?$page_num:0;

        $config['base_url'] = current_url()."?";
        $config['total_rows'] = $total_row;
        $config['per_page'] = 10;
        $config['query_string_segment'] = 'p';
        $config['page_query_string'] = TRUE;
        $this->pagination->initialize($config);

		$data= array(
			'result' => $this->model->getList($page_size, $start_row)
		);

		$this->template->title("User Manager",TITLE);
		$this->template->build('index', $data);
	}

	public function view(){
		$result = $this->model->get("*",FACEBOOK_TB,"fid = '".segment(2). "' AND (uid = '".session('uid')."' OR  list_user like '%\"".session('uid')."\"%')");
		if(!empty($result)){
			set_session('access_token', $result->access_token);
			set_session('fid', $result->fid);

			$reponse = @FB()->get('/'.$result->fid.'?fields=name,access_token,picture.type(large),cover,id,category,talking_about_count,likes', $result->access_token);
			$pages = @$reponse->getGraphPage()->asArray();

			$data = array(
				'info'    => $pages
			);
			$this->template->title(TITLE);
			$this->template->build('view', $data);
		}else{
			redirect(PATH);
		}
	}

	public function update(){
		if(session("admin") == 0){
			redirect(PATH);
		}

		$pages = array();

		//unset_session("fb_token");

		if(get("code")){
			FB_ACCESS_TOKEN();
			redirect("page/add");
		}
		if(session("fb_token")){
			$reponse = FB()->get('/me/accounts?fields=name,access_token,perms,picture.type(large),cover,id,category', session("fb_token"));
			$pages = @json_decode($reponse->getBody())->data;
		}
			
		$id   = (int)get("id");
		$data = array(
			"result"   => $this->model->get("*", $this->table, "id = '{$id}'"),
			"authUrl"  => FB_LOGIN(),
			"pages"    => $pages
		);
		$this->template->title(TITLE);
		$this->template->build('update', $data);
	}

	public function postUpdate(){
		if(session("admin") == 0){
			redirect(PATH);
		}

		$id       = (int)post('id');
        $page_id  = $this->input->post('pages');
	
        if(!empty($page_id)){
        	if(session("fb_token")){
				$reponse = FB()->get('/me/accounts?fields=name,access_token,perms,picture.type(large),cover,id,category', session("fb_token"));
				$pages = @json_decode($reponse->getBody())->data;
				if(!empty($pages)){
					foreach ($pages as $page) {
						$check = $this->model->get("*", FACEBOOK_TB, "fid = '".$page->id."' AND uid = '".session("uid")."'");
						if(in_array($page->id, $page_id) || !empty($check)){
							$check_category = $this->model->get('*', FACEBOOK_CATEGORY_TB, "name_onwer = '{$page->category}' AND uid = '".session("uid")."'");
							$cid = 0;
							if(empty($check_category)){
								$category = array(
									'name'      => $page->category,
									'name_onwer'=> $page->category,
									'uid'       => session("uid"),
					        		'status'    => 1,
					        		'changed'   => NOW,
					        		'created'   => NOW
								);

								$this->db->insert(FACEBOOK_CATEGORY_TB,$category);
								$cid = $this->db->insert_id();
							}else{
								$cid = $check_category->id;
							}

							$data = array(
								"cid"          => $cid,
								"fid"          => $page->id,
								"name"         => $page->name,
								"access_token" => $page->access_token,
								"uid"          => session("uid"),
								"changed"      => NOW,
							);

							if(empty($check)){
								$data["created"] = NOW;
								$this->db->insert(FACEBOOK_TB,$data);
							}else{
								$this->db->update(FACEBOOK_TB,$data,"id = '{$check->id}'");
							}

							unset_session("fb_token");
						}
					}
					$json= array(
						'st' 	=> 'success',
						'txt' 	=> 'Add page successfully'
					);
				}else{
					$json= array(
						'st' 	=> 'error',
						'txt' 	=> 'Token expires'
					);
				}
			}else{
				$json= array(
					'st' 	=> 'error',
					'txt' 	=> 'Token expires'
				);
			}
        }else{
        	$json= array(
				'st' 	=> 'error',
				'txt' 	=> 'Choose at least one page'
			);
        }

		print_r(json_encode($json));
	}

	public function permission(){
		if(session("admin") == 0){
			redirect(PATH);
		}
		$id   = (int)get("id");
		$data = array(
			"result"   => $this->model->get("*", $this->table, "id = '{$id}'"),
		);
		if(session("uid") == 1){
			$data["user"] = $this->model->fetch('*', USER_TB, "id != 1 AND id != '".session('uid')."'");
		}
			
		$this->template->title(TITLE);
		$this->template->build('permission', $data);
	}

	public function postPermission(){
		if(session("admin") == 0){
			redirect(PATH);
		}

		$id          = (int)post('id');
        $list_user   = json_encode($this->input->post('list_user'));
	
        $data = array(
			"list_user" => $list_user,
			"changed"   => NOW,
		);

		$this->db->update(FACEBOOK_TB,$data,"id = '{$id}'");
		$json= array(
			'st' 	=> 'success',
			'txt' 	=> 'Update permission successfully'
		);

		print_r(json_encode($json));
	}

	public function postDelete(){
		if(session("admin") == 0){
			redirect(PATH);
		}

		$id = (int)post('id');
		$POST = $this->model->get('*', $this->table, "id = '{$id}' AND id != 1");
		if(!empty($POST)){
			$this->db->delete($this->table, "id = '{$id}'");
			$json= array(
				'st' 	=> 'success',
				'txt' 	=> 'Delete successfully'
			);
		}else{
			$json= array(
				'st' 	=> 'error',
				'txt' 	=> 'Cannot delete item. Please check back.'
			);
		}
		print_r(json_encode($json));
	}

	public function postDeleteAll(){
		if(session("admin") == 0){
			redirect(PATH);
		}

		$ids =$this->input->post('id');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', $this->table, "id = '{$id}' AND id != 1");
				if(!empty($POST)){
					$this->db->delete($this->table, "id = '{$id}'");
				}
			}
		}
		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> 'Successfully'
		)));
	}

	public function postStatusAll(){
		if(session("admin") == 0){
			redirect(PATH);
		}

		$ids    =$this->input->post('id');
		$status =(int)post('status');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', $this->table, "id = '{$id}'");
				if(!empty($POST)){
					if($id != 1){
						$this->db->update($this->table,array("status" => $status), "id = '{$id}'");
					}
				}
			}
		}
		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> 'Successfully'
		)));
	}

	//Ajax 
	function ajax_reachchart(){
		$data = array(
			'data_reach'              => FB_DATA(session('access_token'), session('fid'), "insights/page_impressions_unique/day"),
			'data_impressions'        => FB_DATA(session('access_token'), session('fid'), "insights/page_impressions/day"),
			'data_reach_paid'         => FB_DATA(session('access_token'), session('fid'), "insights/page_impressions_paid_unique/day"),
			'data_reach_organic'      => FB_DATA(session('access_token'), session('fid'), "insights/page_impressions_organic_unique/day"),
			'data_impressions_paid'   => FB_DATA(session('access_token'), session('fid'), "insights/page_impressions_paid/day"),
			'data_impressions_organic'=> FB_DATA(session('access_token'), session('fid'), "insights/page_impressions_organic/day")
		);
		$this->load->view('chart/rearch', $data, false);
	}

	function ajax_postschart(){
		$data = array(
			'data_page_engaged_users'                            => FB_DATA(session('access_token'), session('fid'), "insights/page_engaged_users/day"),
			'data_page_consumptions'                             => FB_DATA(session('access_token'), session('fid'), "insights/page_consumptions/day"),
			'data_page_consumptions_unique'                      => FB_DATA(session('access_token'), session('fid'), "insights/page_consumptions_unique/day"),
			'data_negative'                                      => FB_DATA_NEGATIVE(session('access_token'), session('fid'), "insights/page_negative_feedback_by_type/day"),
			'data_page_positive_feedback_by_type'                => FB_DATA_POSITIVE_FEEDBACK(session('access_token'), session('fid'), "insights/page_positive_feedback_by_type_unique/day"),
			'data_page_consumptions_by_consumption_type_unique'  => FB_DATA_CLICK_BY_TYPE(session('access_token'), session('fid'), "insights/page_consumptions_by_consumption_type_unique/day"),
			'data_page_posts_impressions_frequency_distribution' => FB_DATA_FREQUENCY(session('access_token'), session('fid'), "insights/page_posts_impressions_frequency_distribution/day"),
			'data_posts_reach'              => FB_DATA(session('access_token'), session('fid'), "insights/page_posts_impressions_unique/day"),
			'data_posts_impressions'        => FB_DATA(session('access_token'), session('fid'), "insights/page_posts_impressions/day"),
			'data_posts_reach_paid'         => FB_DATA(session('access_token'), session('fid'), "insights/page_posts_impressions_paid_unique/day"),
			'data_posts_reach_organic'      => FB_DATA(session('access_token'), session('fid'), "insights/page_posts_impressions_organic_unique/day"),
			'data_posts_impressions_paid'   => FB_DATA(session('access_token'), session('fid'), "insights/page_posts_impressions_paid/day"),
			'data_posts_impressions_organic'=> FB_DATA(session('access_token'), session('fid'), "insights/page_posts_impressions_organic/day")
		);
		$this->load->view('chart/posts', $data, false);
	}

	function ajax_tabchart(){
		$data = array(

			'data_tab'                                      => FB_DATA_TAB(session('access_token'), session('fid'), "insights/page_tab_views_login_top_unique/day"),
			'data_page_impressions_frequency_distribution'  => FB_DATA_FREQUENCY(session('access_token'), session('fid'), "insights/page_impressions_frequency_distribution/day"),
			'data_page_storytellers_by_story_type'          => FB_DATA_STRORYTELLERS(session('access_token'), session('fid'), "insights/page_storytellers_by_story_type/day"),
		);
		$this->load->view('chart/tab', $data, false);
	}

	function ajax_fanschart(){
		$data = array(
			'data_fanshour' => FB_DATA_FANS_ONLINE(session('access_token'), session('fid'), "insights/page_fans_online/day"),
			'data_fansday'  => FB_DATA(session('access_token'), session('fid'), "insights/page_fans_online_per_day/day"),
		);
		$this->load->view('chart/fans', $data, false);
	}

	function ajax_likeschart(){
		$data = array(
			'data_fans'        => FB_DATA(session('access_token'), session('fid'), "insights/page_fans/lifetime"),
			'data_fan_adds'    => FB_DATA(session('access_token'), session('fid'), "insights/page_fan_adds/day"),
			'data_fan_removes' => FB_DATA(session('access_token'), session('fid'), "insights/page_fan_removes/day")
		);
		$this->load->view('chart/likes', $data, false);
	}

	function ajax_genderchart(){
		$data = array(
			'data_fans_gender_age'                       => FB_DATA_GENDER(session('access_token'), session('fid'), "insights/page_fans_gender_age/lifetime"),
			'data_fans_storytellers_gender_age'          => FB_DATA_GENDER(session('access_token'), session('fid'), "insights/page_storytellers_by_age_gender/day"),
			'data_page_impressions_by_age_gender_unique' => FB_DATA_GENDER(session('access_token'), session('fid'), "insights/page_impressions_by_age_gender_unique/day")
		);
		
		$this->load->view('chart/gender', $data, false);
	}

	function ajax_countrychart(){
		$data = array(
			'data_page_fans_country'                  => FB_DATA_COUNTRY(session('access_token'), session('fid'), "insights/page_fans_country/lifetime"),
			'data_page_storytellers_by_country'       => FB_DATA_COUNTRY(session('access_token'), session('fid'), "insights/page_storytellers_by_country/day"),
			'data_page_impressions_by_country_unique' => FB_DATA_COUNTRY(session('access_token'), session('fid'), "insights/page_impressions_by_country_unique/day")
		);
		
		$this->load->view('chart/country', $data, false);
	}

	function ajax_citychart(){
		$data = array(
			'data_page_fans_city'                  => FB_DATA_COUNTRY(session('access_token'), session('fid'), "insights/page_fans_city/lifetime"),
			'data_page_storytellers_by_city'       => FB_DATA_COUNTRY(session('access_token'), session('fid'), "insights/page_storytellers_by_city/day"),
			'data_page_impressions_by_city_unique' => FB_DATA_COUNTRY(session('access_token'), session('fid'), "insights/page_impressions_by_city_unique/day")
		);
		
		$this->load->view('chart/city', $data, false);
	}
	
	function ajax_sourcechart(){
		$data = array(
			'data_page_views_external_referrals' => FB_DATA_REFERRERS(session('access_token'), session('fid'), "insights/page_views_external_referrals/day"),
			'data_page_fans_by_like_source'      => FB_DATA_SOURCE(session('access_token'), session('fid'), "insights/page_fans_by_like_source/day"),
		);
		
		$this->load->view('chart/source', $data, false);
	}
}
