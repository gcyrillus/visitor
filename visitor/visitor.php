<?php
    if(!defined('PLX_ROOT')) {
        die('oups!');
    }

    class visitor extends plxPlugin {
        const HOOKS = array(
            'AdminPrepend',
            'AdminTopEndHead',
            'AdminUsersTop',
            'AdminAuthEndHead',
        );
        const BEGIN_CODE = '<?php' . PHP_EOL;
        const END_CODE = PHP_EOL . '?>';

        public function __construct($default_lang) {
        # appel du constructeur de la classe plxPlugin (obligatoire)
        parent::__construct($default_lang);

            # Ajoute des hooks
            foreach(self::HOOKS as $hook) {
                $this->addHook($hook, $hook);
            }
        }

		        public function AdminPrepend() {
            echo self::BEGIN_CODE;
?>
         const PROFIL_VISITOR = 5;  
<?php
            echo self::END_CODE;
        }
		
        public function AdminTopEndHead() {
            echo self::BEGIN_CODE;
?>
            if(isset($_SESSION['profil']) and $_SESSION['profil'] == '5') { header("location: ".$_COOKIE['page']);} 
<?php
            echo self::END_CODE;
        }

        public function AdminUsersTop() {
            echo self::BEGIN_CODE;
?>
            # Tableau des profils
            $aProfils = array(
                PROFIL_ADMIN => L_PROFIL_ADMIN,
                PROFIL_MANAGER => L_PROFIL_MANAGER,
                PROFIL_MODERATOR => L_PROFIL_MODERATOR,
                PROFIL_EDITOR => L_PROFIL_EDITOR,
                PROFIL_WRITER => L_PROFIL_WRITER,
                PROFIL_VISITOR => L_PLUGINS_REQUIREMENTS_NONE  // affiche aucun en fr à partir des fichiers lang de PluXml
            );

<?php
            echo self::END_CODE;
        } 

        public function AdminAuthEndHead() {
            echo self::BEGIN_CODE;
?>
            if(isset($_GET['page'])) {setcookie("page",   $_GET['page']) ;}
<?php
            echo self::END_CODE;
        }
    }
