<?php  
define('ABSPATH', dirname(__FILE__));   // caminho para o sistema

define('DS_MAIL_TO', 'desenvolvimento3@mundods.com.br');
//define('DS_MAIL_TO', '');
define('NAME_CLIENT', 'DS Intranet'); // ex. DS Marketing
define('MSG_NEWSLETTER_CLIENT', 'Cadastro na newsletter, feito pelo site.');
define('MSG_CONTACT_CLIENT', 'Contato feito pelo site.');

function base_url(){

	$url = '';

	if( isset($_SERVER['SERVER_ADDR']) && ($_SERVER['SERVER_ADDR'] === "127.0.0.1" || $_SERVER['SERVER_ADDR'] == '::1'))
		$url = 'http://localhost:8000';
	else 
		$url = 'http://localhost:8000'; // http://digitalstudio2.com.br/projects_ds/dsintranet';
	return $url;

}

function ds_mail($to, $subject, $message, $from){

	$charset = 'iso-8859-1';
	//$charset = 'utf-8';
	$headers = array();
	$headers[] = "From: ".$from; 
  $headers[] = "Reply-To: ".$from; 
  $headers[] = "Return-Path: ".$from; 
  $headers[] = "X-Mailer: php"; 
  $headers[] = 'MIME-Version: 1.0'; 
  $headers[] = 'Content-type: text/html; charset='.$charset; 

  $header = implode(PHP_EOL, $headers);

	if( mail($to, $subject, $message, $header) )
		return true;
	else
		return false;

}

$page = 'home';
if( isset($_GET['page']) && strlen($_GET['page']) > 1 && strpos($_GET['page'], 'index') === FALSE ){
	$page = $_GET['page'];
}

$file = 'pages/'.$page . '.php';
if( !file_exists($file) )
	$page = 'home';

$msg_news = null;
/**
 * SEND NEWSLLETER
 */
if( !empty($_POST) && isset($_POST['send_newsletter']) ){


	$to 		= DS_MAIL_TO;
	$nome 	= $_POST['name'];
	$email 	= $_POST['email'];
	//$born 	= $_POST['born'];
	$br 		= '<br>';

	$from 	= $email;

	$subject = '['.NAME_CLIENT.'] Cadastro em Newsletter';

	$sent 	= false;

	$message = "
	Olá,  $br
	$br
	".MSG_NEWSLETTER_CLIENT." $br
	$br
	Nome: $nome $br
	E-Mail: $email $br
	$br
	==== FIM EMAIL ====
	";

	$sent = ds_mail($to, $subject, $message, $from);

	if( $sent )
		$msg_news = '<script>alert("Cadastrado com sucesso!");</script>';
	else
		$msg_news = '<script>alert("Erro ao cadastrar. Por favor, tente novamente.");</script>';

}

?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title><?php echo NAME_CLIENT; ?></title>

	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<base href="<?php echo base_url(); ?>/">

	<!-- styles start -->
	<link rel="stylesheet" type="text/css" href="media/css/style.css?v=<?php echo mt_rand(100, 500); ?>" />

</head>
<body>

	<?php if( !is_null(@$msg_news) ) echo $msg_news; ?>

	<div id="wrapper" class="page-<?php echo $page; ?>">

		<div id="bg-top"></div>

		<div id="wrapper-container">

			<div id="header">
				
				<div id="header-container" class="central">

					<div id="header-logo">

						<a href="#">
							<img src="media/images/logo-ds.png" alt="" />
						</a>

					</div><!-- end #header-logo -->
	<!-- 
					<div id="header-right"> -->

						<div id="header-logodsintranet"></div>

						<div id="header-social-media">
							
							<ul>
								<li><a target="_blank" href="#twiter" class="social-links social-tw"></a></li>
								<li><a target="_blank" href="#facebook" class="social-links social-fb"></a></li>
								<li><a target="_blank" href="#G+" class="social-links social-gp"></a></li>
								<li><a target="_blank" href="#LinkeIn" class="social-links social-in"></a></li>
							</ul>

						</div><!-- end #header-social-media -->

						<div id="header-welcome-info">

							<div id="header-welcome-info-left">
								
								<div id="txt-header-welcome">Seja Bem-Vindo</div>
								<div id="txt-header-username">Ítalo Ventura</div>

							</div><!-- end #header-welcome-info-left -->

							<div id="header-welcome-info-right">

								<div id="header-time-info">18:49</div>

							</div><!-- end #header-welcome-info-right -->

						</div><!-- end #header-welcome-info -->

					<!--/div><!-- end #header-right -->

				</div><!-- end #header-container -->

				<div id="pre-container-info">

					<div id="pre-container-info-container" class="central">

						<div id="quote-day">
							<div class="qd-title">Frases</div>
							<div class="qd-quote">"Não sabendo que era impossível, ele foi lá e fez."</div>
							<div class="qd-by">Henry Ford</div>
						</div><!-- end #quote-day -->

						<div id="widgets-weather">
							<!-- Yahoo! Tempo Badge --><iframe allowtransparency="true" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" class="navigation" src="http://br.tempo.yahoo.com/_external/badge/?id=26800889&l=navigation&t=trans&u=c" height="55px" width="350px"></iframe><noscript><a href="http://br.tempo.yahoo.com/brasil/rio-de-janeiro/maca%C3%A9-26800889/">Macaé Tempo</a> from <a href="http://br.tempo.yahoo.com">Yahoo! Tempo</a></noscript><!-- Yahoo! Tempo Badge -->
						</div><!-- end #widgets-weather -->

					</div><!-- end #pre-container-info-container -->

				</div><!-- end #pre-container-info -->

			</div><!-- end #header -->

			<div id="container">

				<?php include('pages/'.$page.'.php'); ?>

			</div><!-- end #container -->

		</div><!-- end #wrapper-container -->

		<div id="footer">

			<div id="footer-container" class="central">

			</div><!-- end #footer-container -->

		</div><!-- end #footer -->

	</div><!-- end #wrapper -->

	<!-- styles -->
	<link rel="stylesheet" type="text/css" href="media/css/jquery.jscrollpane.css" media="all" />
	<link rel="stylesheet" type="text/css" href="media/css/prettyPhoto.css" />

	<!-- javascript start -->
	<script type="text/javascript" src="media/js/jquery.min.js?v=1.7.2"></script>
	<script type="text/javascript" src="media/js/jquery.cycle.all.js?v=2.88"></script>
	<script type="text/javascript" src="media/js/jquery.mousewheel.js?v=3.0.6"></script>
	<script type="text/javascript" src="media/js/mwheelIntent.js?v=1.2"></script>
	<script type="text/javascript" src="media/js/jquery.jscrollpane.min.js?v=2.0.0beta12"></script>
	<script type="text/javascript" src="media/js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function($){

		/** scrollbar example */
		$('.scrollbar').jScrollPane({showArrows:true});

		/** slideshow example */
		$('#slideshow').cycle({ 
	    fx:     'fade', 
	    speed:  'slow', 
	    //timeout: 0, 
	    pager:  '#slideshow-nav', 
	    /*pagerAnchorBuilder: function(idx, slide) { 
        return '<a href="#">0' + (idx+1) + '</a>'; 
    	} */
    	before: function(){
    		$(this).find('.slideshow-blocks-description').css('bottom', '-50px');
    	}, 
    	after: function(){
    		$(this).find('.slideshow-blocks-description').animate({'bottom':'0px'}, 1000);
    	},
		});

		/** tricks to hide text forms */ 
		$('.input_text').bind('focusout', function(){

			var str = $(this).val();

			if( str.length > 0 ){

				$(this).addClass('active');

			} else {

				$(this).removeClass('active');

			}

		});

		/** active prettyphoto plugin */
    $("a[rel^='prettyPhoto']").prettyPhoto({
    	social_tools: '',
    	//theme: 'dark_square'
    });

	});
	</script>

	<link href='http://fonts.googleapis.com/css?family=Capriola' rel='stylesheet' type='text/css'>

</body>
</html>