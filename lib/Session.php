<?php 

	/**
	* Sesstion Class
	*/
	class Session
	{
		public static function init(){
			session_start();
		}	
		public static function set($key,$val){
			$_SESSION[$key] = $val;
		}	
		public static function get($key){
			if(isset($_SESSION[$key])){
				return $_SESSION[$key];
			
		}else{
			return false;
		}		
	}

	public static function checkSession(){
		self::init();
		if(self::get("login") == false){
			self::destroy();
			echo "<script>window.location='login.php'</script>";
		}
	}

	public static function checkLogin(){
		self::init();
		if(self::get("login") == true){
			echo "<script>window.location='index.php'</script>";
			
		}
	}
	public static function destroy(){
		session_destroy();
		echo "<script>window.location='login.php'</script>";
	}

	public static function unset_it($key){
		unset($_SESSION[$key]);
	}

}

 ?>