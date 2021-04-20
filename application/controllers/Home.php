<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	function __construct() {
        parent::__construct();
    	$this->load->model('Preferences_model');
        $this->load->model('Retreats_model');
        $this->load->model('Posts_model');
        $this->load->model('Plans_model');
        $this->load->model('Users_model');
        $this->load->model('Book_now_model');
        $this->load->model('Dubai_studio_model');
        $this->load->model('Journal_model');
        $this->load->model('Favourites_model');
        $this->load->model('Live_stream_model');
        $this->load->model('Home_video_model');
    	$this->load->model('Common_model');
    	$this->load->model('Instagram_model');
    	$this->load->model('Testimonials_model');
    	$this->load->model('Sliderimages_model');
    	$this->load->model('Secondslider_model');
    	$this->load->model('Follow_model');
    	$this->load->model('Emailtemplates_model');
    	$this->load->model('Free_testers_model');
    	$this->load->model('Retreatsphotos_model');
    	$language 				= $this->Common_model->get_language_name();
    	$this->data['language'] = $language;
    	$this->load->language("access",$language);

    	initialized_stripe();
    }

	public function index(){
		$this->data['tab_title'] 	=  TAB_TITLE.' | Home';
		$this->data['page_title'] 	=  'Home';
 		$this->load->view('home',$this->data);
	}


	public function checkSelectedVideo(){
		$video_id = $this->input->post('video_id');
		$check = $this->Home_video_model->checkSelectedVideo($video_id);
		if($check){
			$output['success'] = true;
		}else{
			$output['success'] = false;
		}

		echo json_encode($output);
	}

	public function ondemand(){
		$this->data['tab_title'] 	=  TAB_TITLE.' | On Demand';
		$this->data['page_title'] 	=  'Yoga Rituals';
		$this->data['duaration']    = $this->Home_video_model->getAllHome_videoduaratioslots();
		$this->data['style']        = $this->Home_video_model->getAllHome_videostyleslots();
		$this->data['difficulity']  = $this->Home_video_model->getAllHome_videodifficultyslots();
		$this->data['home_video']   = $this->Home_video_model->getAllHome_video(12, 0);
		$this->data['total_videos']   = $this->Home_video_model->countAllHomeVideo();
		$this->data['allowvideo']="";
		$this->data['selectedvideos'] 	= array();
		$this->data['typeruser']   = 'test';
		
 		if($this->session->userdata('user_id') !=""){
 			$this->data['users']= $this->Users_model->getRow($this->session->userdata("user_id"));
 			$this->data['typeruser']   = $this->data['users']['plan_duration'];
 			$fav = $this->Favourites_model->getAllFavourites($this->session->userdata('user_id'));
            $this->data['selectedvideos'] 	= array();
			foreach ($fav as  $value) {
				$this->data['selectedvideos'][] = array('id' => $value->product_id);
			}
 			$allowvideo = $this->Favourites_model->videoallowtowatch($this->session->userdata('user_id'));
			$this->session->set_userdata(array('fav'=>count($fav)));	
 		}
 		if (!empty($allowvideo)) {
			$this->data['allowvideo']= $allowvideo['product_id'];

		}
		

 		
 		$this->load->view('ondemand',$this->data);
	}

	public function loadmoredata(){
		$start = $this->input->post('val');
		$limit = 12;
		$this->data['home_video'] = $this->Home_video_model->getAllHome_video($limit, $start);
		$this->data['allowvideo']="";
		$this->data['selectedvideos'] 	= array();
		$this->data['typeruser']   = 'test';
		if($this->session->userdata('user_id') !=""){
 			$this->data['users']= $this->Users_model->getRow($this->session->userdata("user_id"));
 			$this->data['typeruser']   = $this->data['users']['plan_duration'];
 			$fav = $this->Favourites_model->getAllFavourites($this->session->userdata('user_id'));
            $this->data['selectedvideos'] 	= array();
			foreach ($fav as  $value) {
				
				$this->data['selectedvideos'][] = array(
						'id'  				=> $value->product_id
						
					);
			}
 			$allowvideo = $this->Favourites_model->videoallowtowatch($this->session->userdata('user_id'));
			$this->session->set_userdata(array('fav'=>count($fav)));	
 		}
 		if (!empty($allowvideo)) {
			$this->data['allowvideo']= $allowvideo['product_id'];

		}
		echo $this->load->view('loadmorevideos',$this->data, true);
	}

	public function filterduaration(){
		$this->data['home_video']	=	$this->Home_video_model->getAllHome_videobyduaration($this->input->post('duaration'));
		$this->data['allowvideo']="";
		$this->data['selectedvideos'] 	= array();
		$this->data['typeruser']   = 'test';
		if($this->session->userdata('user_id') !=""){
 			$this->data['users']= $this->Users_model->getRow($this->session->userdata("user_id"));
 			$this->data['typeruser']   = $this->data['users']['plan_duration'];
 			$fav = $this->Favourites_model->getAllFavourites($this->session->userdata('user_id'));
            $this->data['selectedvideos'] 	= array();
			foreach ($fav as  $value) {
				
				$this->data['selectedvideos'][] = array(
						'id'  				=> $value->product_id
						
					);
			}
 			$allowvideo = $this->Favourites_model->videoallowtowatch($this->session->userdata('user_id'));
			$this->session->set_userdata(array('fav'=>count($fav)));	
 		}
 		if (!empty($allowvideo)) {
			$this->data['allowvideo']= $allowvideo['product_id'];
		}

		$this->load->view('duaration_data',$this->data);
	}

	public function getVideosByDuaration(){
		$this->data['home_video']	=	$this->Home_video_model->getVideosByDuaration($this->input->post('duaration'), $this->input->post('type'));
		$this->data['allowvideo']="";
		$this->data['selectedvideos'] 	= array();
		$this->data['typeruser']   = 'test';
		if($this->session->userdata('user_id') !=""){
 			$this->data['users']= $this->Users_model->getRow($this->session->userdata("user_id"));
 			$this->data['typeruser']   = $this->data['users']['plan_duration'];
 			$fav = $this->Favourites_model->getAllFavourites($this->session->userdata('user_id'));
            $this->data['selectedvideos'] 	= array();
			foreach ($fav as  $value) {
				
				$this->data['selectedvideos'][] = array(
						'id'  				=> $value->product_id
						
					);
			}
 			$allowvideo = $this->Favourites_model->videoallowtowatch($this->session->userdata('user_id'));
			$this->session->set_userdata(array('fav'=>count($fav)));	
 		}
 		if (!empty($allowvideo)) {
			$this->data['allowvideo']= $allowvideo['product_id'];
		}

		$this->load->view('duaration_data',$this->data);
	}
	public function filterstyle(){
		$this->data['home_video']	=	$this->Home_video_model->getAllHome_videobystyle($this->input->post('style'));
		$this->data['allowvideo']="";
		$this->data['selectedvideos'] 	= array();
		$this->data['typeruser']   = 'test';
		if($this->session->userdata('user_id') !=""){
 			$this->data['users']= $this->Users_model->getRow($this->session->userdata("user_id"));
 			$this->data['typeruser']   = $this->data['users']['plan_duration'];
 			$fav = $this->Favourites_model->getAllFavourites($this->session->userdata('user_id'));
            $this->data['selectedvideos'] 	= array();
			foreach ($fav as  $value) {
				$this->data['selectedvideos'][] = array(
						'id' => $value->product_id
					);
			}
 			$allowvideo = $this->Favourites_model->videoallowtowatch($this->session->userdata('user_id'));
			$this->session->set_userdata(array('fav'=>count($fav)));	
 		}
 		if (!empty($allowvideo)) {
			$this->data['allowvideo']= $allowvideo['product_id'];
		}
		$this->load->view('styledata_data',$this->data);
	}
	public function filterdiff(){
		$this->data['home_video']	=	$this->Home_video_model->getAllHome_videobydifficulti($this->input->post('diff'));
		$this->data['allowvideo']="";
		$this->data['selectedvideos'] 	= array();
		$this->data['typeruser']   = 'test';
		if($this->session->userdata('user_id') !=""){
 			$this->data['users']= $this->Users_model->getRow($this->session->userdata("user_id"));
 			$this->data['typeruser']   = $this->data['users']['plan_duration'];
 			$fav = $this->Favourites_model->getAllFavourites($this->session->userdata('user_id'));
            $this->data['selectedvideos'] 	= array();
			foreach ($fav as  $value) {
				$this->data['selectedvideos'][] = array(
						'id' => $value->product_id
					);
			}
 			$allowvideo = $this->Favourites_model->videoallowtowatch($this->session->userdata('user_id'));
			$this->session->set_userdata(array('fav'=>count($fav)));	
 		}
 		if (!empty($allowvideo)) {
			$this->data['allowvideo']= $allowvideo['product_id'];
		}
		$this->load->view('diffdata_data',$this->data);
	}
	public function retreats(){
		$this->data['tab_title'] 	=  TAB_TITLE.' | Retreats';
		$this->data['instagram']  	= $this->Instagram_model->getInsta();
		$this->data['testimonials'] = $this->Testimonials_model->getAllTestimonialsRetreats();
		$this->data['test']         = $this->Retreats_model->getAllRetreats();
		$this->data['page_title'] 	= 'Retreats';
 		$this->load->view('retreats',$this->data);
	}

	public function retreats_photos(){
		$this->data['tab_title'] 	=  TAB_TITLE.' | Retreats Past Photos';
		$this->data['posts']  	= $this->Retreatsphotos_model->getAllForUser();
		$this->data['page_title'] 	= 'Retreats Past Photos';
 		$this->load->view('retreats_photos',$this->data);
	}

	public function favourites(){
		$this->data['tab_title']	=  TAB_TITLE.' | Favorites';

		$fav 						= $this->Favourites_model->getAllFavourites($this->session->userdata('user_id'));
		$allowvideo = $this->Favourites_model->videoallowtowatch($this->session->userdata('user_id'));
		if (!empty($allowvideo)) {
			$this->data['allowvideo']= $allowvideo['product_id'];
		}else{
			$allowvideo['product_id']="";
			$this->data['allowvideo']="";
		}
		
		$this->data['favourites'] 	= array();
		foreach ($fav as  $value) {
			$products = $this->Favourites_model->getAllFavouritesvidoesofuser($value->product_id);
			$this->data['favourites'][] = array(
					'id'  				=> $products['id'],
					'title'  			=> $products['title'],
					'video_link'  		=> $products['video_link'],
					'description'  		=> $products['description'],
					'spotify_link'  	=> $products['spotify_link'],
					'picture_main'  	=> $products['picture_main'],
					'date_modified' 	=> $products['date_modified'],
					'date_created'  	=> $products['date_created'],
					'allowvideo'  	=> $allowvideo['product_id'],
					'slug' 	 			=> $products['slug'],
					'videoType'			=> $products['videoType'],	
					'video_duaration' 	=> $products['video_duaration'],
					'file_name' 		=> $products['file_name']
				);
		}
		
		$this->data['page_title'] =  'Favorites';
 		$this->load->view('favourites',$this->data);
	}
	public function journal(){
		$this->data['tab_title'] 	=  TAB_TITLE.' | Journal';
		$this->data['instagram']  	= $this->Instagram_model->getInsta();
		$this->data['journal']      = $this->Journal_model->getAllJournal();
		$this->data['page_title'] 	=  'Journal';
 		$this->load->view('journal',$this->data);
	}
	public function journal_detail($slug){
		$this->data['tab_title'] 		=  TAB_TITLE.' | journal detail';
		$this->data['journalDetail']    = $this->Journal_model->getAllJournalDetail($slug);
		$this->data['page_title'] 		=  $this->data['journalDetail']['title'];
 		$this->load->view('post-detail',$this->data);
	}
	public function privacy_terms(){
		$this->data['tab_title'] 	=  TAB_TITLE.' | Privacy & Terms';
		$this->data['page_title'] 	=  'Privacy & Terms';
 		$this->load->view('privacy-terms',$this->data);
	}
	public function plans($trial){
		if ($this->session->userdata('user_id')!='') {
			$this->data['membership_history']   = $this->Users_model->getPurchaseHistory($this->session->userdata('user_id'));
			$this->data['plans'] 			= $this->Plans_model->getAllPlansSecond($this->data['membership_history']['plan_duration']);
			$this->data['trial'] = $trial;
		}else{
			$this->data['plans'] 		= $this->Plans_model->getAllPlans($trial);
			$this->data['trial'] = $trial;
		}
		
 		return $this->load->view('common/plans',$this->data);
	}
	public function plans1(){
		$this->data['plans'] 		= $this->Plans_model->getAllPlans();
 		return $this->load->view('common/plans1',$this->data);
	}
	public function login(){
		return $this->load->view('common/login_page');
	}
	public function newsletter(){
		return $this->load->view('common/newsletter');
	}
	public function posts($id){
		$this->data['tab_title'] 		=  TAB_TITLE.' | South of France June 2020 retreat';
		$this->data['page_title'] 		= 'South of France June 2020 retreat';
		$this->data['posts']      		= $this->Posts_model->getAllPostsretreats($id);
		$this->data['book_now']         = $this->Book_now_model->getAllBook_nowretreats($id);
 		$this->load->view('posts',$this->data);
	}
	public function live_stream(){
		$this->data['tab_title'] 		=  TAB_TITLE.' | Live Stream';
		$this->data['live_stream']  	= $this->Live_stream_model->getLive_stream();
		$this->data['page_title'] 		=  'Live Stream';
 		$this->load->view('live-stream',$this->data);
	}
	public function live_stream_classes(){
		$this->data['tab_title'] 		=  TAB_TITLE.' | Live Stream Classes';
		$this->data['testimonials'] 	= $this->Testimonials_model->getAllTestimonialsClasses();
		$this->data['live_stream']  	= $this->Live_stream_model->getLive_stream();
		$this->data['page_title'] 		=  'Live Stream Classes';
		$this->data['msg'] = $this->session->flashdata('msg');
 		$this->load->view('live-stream-classes',$this->data);
	}
	public function memberships(){
		$this->data['tab_title'] 		=  TAB_TITLE.' | Membership';
		$this->data['plans'] 			= $this->Plans_model->getAllPlans('join_now');
		if ($this->session->userdata('user_id')!='') {
			$this->data['membership_history']   = $this->Users_model->getPurchaseHistory($this->session->userdata('user_id'));
		$this->data['planssecond'] 			= $this->Plans_model->getAllPlansSecond($this->data['membership_history']['plan_duration']);
		}
		
		$this->data['testimonials'] 	= $this->Testimonials_model->getAllTestimonialsMember();
		$this->data['page_title'] 		=  'Membership';
 		$this->load->view('memberships',$this->data);
	}
	public function user_account(){
		$this->data['tab_title'] 		=  TAB_TITLE.' | User Account';
		$this->data['page_title'] 		=  'User Account';
 		$this->load->view('user-account',$this->data);
	}
	public function private_corporate(){
		$this->data['tab_title'] 		=  TAB_TITLE.' | Private + Corporate';
		$this->data['page_title'] 		=  'Private + Corporate';
 		$this->load->view('private-corporate',$this->data);
	}
	public function in_studio(){
		$this->data['tab_title'] 		=  TAB_TITLE.' | In Studio';
		$this->data['page_title'] 		=  'In Studio';
		$this->data['dubai_studio']         = $this->Dubai_studio_model->getAllDubai_studio();

 		$this->load->view('dubai-studio',$this->data);
	}
	public function checkout_retreats($slug){
		$this->data['tab_title'] 		=  TAB_TITLE.' | Checkout';
		$this->data['page_title'] 		=  'Checkout';
		$this->data['users']= $this->Users_model->getRow($this->session->userdata("user_id"));
		$this->data['plansCheckout']   = $this->Plans_model->getAllplansCheckoutretreasts($slug);

		try {
			$payment_intent = \Stripe\PaymentIntent::create([
			  'payment_method_types' => ['card'],
			  'amount' => $this->data['plansCheckout']['plan_price']*100,
			  'currency' => 'usd'
			]);
		} catch (Exception $e) {
		  	 echo json_encode($e->jsonBody);
		}

		$this->data['client_secret'] = $payment_intent->client_secret;
 		$this->load->view('checkout-retreats',$this->data);
	}
	public function checkout_dubai($slug){
		$this->data['tab_title'] 		=  TAB_TITLE.' | Checkout Dubai Studio';
		$this->data['page_title'] 		=  'Checkout Dubai Studio';
		$this->data['users']= $this->Users_model->getRow($this->session->userdata("user_id"));
		$this->data['plansCheckout']   = $this->Plans_model->getAllplansCheckout($slug);


 		$this->load->view('checkout-dubai-studio',$this->data);
	}
	public function checkout($slug){
		$this->data['tab_title'] 		=  TAB_TITLE.' | Checkout ';
		$this->data['type'] 			= $slug;
		$this->data['plansChechout']    = $this->Plans_model->getAllplansChechout($slug);
		$this->data['page_title'] 		=  'Checkout';
 		$this->load->view('checkout',$this->data);
	}
	public function thankyou(){
		$this->data['tab_title'] 	=  TAB_TITLE.' | Thank You';
		$this->data['slider']  	= $this->Sliderimages_model->getSliderimagesMain();
		$this->data['page_title'] 	=  'Thank You';
 		$this->data['instagram']  	= $this->Instagram_model->getInsta();
 		$this->load->view('thankyou',$this->data);
	}
	public function retreats_thanks(){
		$this->data['tab_title'] 	=  TAB_TITLE.' | Thank You, John';
		$this->data['slider']  	= $this->Sliderimages_model->getSliderimagesRetreat();
		$this->data['page_title'] 	=  'Thank You, John';
		$this->data['instagram']  	= $this->Instagram_model->getInsta();
 		$this->load->view('retreats-thanks',$this->data);
	}
	public function dubai_thanks(){
		$this->data['tab_title'] 	=  TAB_TITLE.' | Thank You, John';
		$this->data['slider']  	= $this->Sliderimages_model->getSliderimagesDubai();
		$this->data['page_title'] 	=  'Thank You, John';
 		$this->load->view('dubai-studio-thanks',$this->data);
	}
	public function purchase_history(){
		if($this->session->userdata('user_id')=='') {
			redirect('home');
		}
		$this->data['tab_title'] 	=  TAB_TITLE.' | Purchase History';
		$this->data['page_title'] 	=  'Purchase History';
		$this->data['days'] = 0;
		$this->data['history']    	= $this->Users_model->getPurchaseHistory($this->session->userdata('user_id'));
		if($this->data['history']['plan_duration'] =='year'){
			$date =  $this->Users_model->getSubscriptionEndDateByUserId($this->session->userdata('user_id'));
			$now = time();
			$date = strtotime($date);
			$datediff = $date - $now;
			$days =  round($datediff / (60 * 60 * 24));
			$this->data['days'] = $days;
		}

 		$this->load->view('purchase-history',$this->data);
	}
	public function retreats_book(){
		$this->data['tab_title'] 	=  TAB_TITLE.' | Booked Retreats';
		$this->data['page_title'] 	=  'Booked Retreats';
		$history   = $this->Users_model->getRetreartsHistory($this->session->userdata('user_id'));

		$this->data['retreats'] 	= array();
		foreach ($history as  $value) {
			$products = $this->Favourites_model->getAllretreatsforuser($value->retreat_id);
			
			$this->data['retreats'][] = array(
					'id'  				=> $products['id'],
					'title'  			=> $products['title'],
					'heading'  		=> $products['heading'],
					'details'  		=> $products['details'],
					'picture_main'  	=> $products['picture_main'],
					'picture_s1'  	=> $products['picture_s1'],
					
				);
		}
		
 		$this->load->view('retreats-history',$this->data);
	}

	public function booking($id){				
		$user_record	=	$this->Users_model->getRow($this->session->userdata('user_id'));
		if($user_record){
			$link = $this->Live_stream_model->getLink($id);
			$email_arr = array("name"=>$user_record['f_name']." ".$user_record['l_name'],"link"=>$link, "email"=>$user_record['email']);
			$result = $this->Emailtemplates_model->sendEmail('booking',$email_arr);
			
			$this->session->set_flashdata('msg','Zoom link has been sent to your email successfully!');
			redirect(base_url().'Home/live_stream_classes#here');
		}else{

			$this->session->set_flashdata('msg','Please login first!');
			redirect(base_url().'Home/live_stream_classes#here');
		}
	}
}
