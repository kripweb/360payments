<?php
/* Template Name: Velox */
?>

<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>
<style>
	.veloxcontain {
		position:relative;
	}
	
	.veloxcontain .clearfix:after {
	  content: "";
	  display: table;
	  clear: both;
	}
	#veloxcontain .main_content {
		position: relative;
		margin-right: auto;
		margin-left: auto;
		max-width: 1195px;
	}
	
	#veloxcontain #sidebar {
		float: left;
		position: relative;
		left: 0;
		width: 275px;
		z-index: 999;
	}
	#veloxcontain .menu {
		font-size: 90%;
		list-style: none;
		margin: 0;
		padding: 0;
		vertical-align: top;
		width: 200px;
	}
	#veloxcontain .menu ul {
		display: none;
		list-style: none;
		margin-left: 10px;
		padding: 0;
	}
	#veloxcontain .menu li {
		background-image: none;
		margin: 0;
		padding: 0;
	}
	#veloxcontain .menu ul li a {
		padding-left: 20px;
		width: 200px;
	}
	#veloxcontain .menu a {
		cursor: pointer;
		display: block;
		margin-left: 0;
		padding: 2px 2px 2px 17px;
		width: 200px;
		text-decoration: none;
		color: #222;
		font-size:13px;
		font-family: 'Segoe UI', Verdana, Arial;
	}
	#veloxcontain .menu>li>a {
		font-size:16px;
		line-height:17px;
	}
	
	#veloxcontain .menu .folder {
		margin-top:15px;
	}
	}
	/*
	#veloxcontain .menu a.expanded {
		background: url('../images/arrow_expand.gif') no-repeat 5px 60%;
	}
	#veloxcontain .menu a.collapsed {
		background: url('../images/arrow_collapse.gif') no-repeat 5px 60%;
	}
	*/
	#veloxcontain .menu a.back {
		font-style: italic;
	}
	#veloxcontain .menu a:hover {
		text-decoration: none;
		color: #79AD37;
	}
	#veloxcontain .menu a.active {
		color: #79AD37;
	}
	#veloxcontain .menu ul a {
		border-top: 2px solid #fff;
		display: block;
		font-weight: normal;
		padding: 2px 2px 2px 10px;
		width: 200px;
	}
	#veloxcontain .subfolder,
	#veloxcontain .folder {
		margin-left: 10px;
	}
	#veloxcontain .content {
		display: none;
	}
	#veloxcontain .current_content {
		display: block;
		/* position: absolute; */
		padding: 20px;
		margin-left: 275px;
		background:#f6f6f6;
		
	}
	
	#veloxcontain .header
	{
		/*
		position: fixed;
		top: 0;
		width: 100%;
		max-width: 1195px;
		height: 60px;
		border-bottom: 1px solid #bbb;
		background-color: #FFFFFF;
		z-index: 1000;
		*/
		display:none;
	}
	#veloxcontain .header h1
	{
		color: black;
	}
	#veloxcontain #portal
	{
		position: relative;
	}
	
	
	#veloxcontain .current_content,
	#veloxcontain .content
	{
		width: 65%;
		max-width: 920px;
		page-break-after: always;
	}
	#veloxcontain .content:last-child
	{
		width: 65%;
		max-width: 920px;
		page-break-after: auto;
	}
	#veloxcontain table
	{
		border-collapse:collapse;
		max-width: 920px;
		width: 100%;
	}
	#veloxcontain table, #veloxcontain th, #veloxcontain td
	{
		border: 1px solid #bbb;
		padding: 2px 2px 2px 5px;
	}
	#veloxcontain th
	{
		background-color: #ededed;
		color: #707070;
	}
	#veloxcontain #cart_list
	{

	}
	#veloxcontain #cart_list,
	#veloxcontain #cart_list td
	{
		border: 0px;
		padding-right: 20px;
		padding-bottom: 4px;
	}
	#veloxcontain #cart_list td > a
	{
		display: table-cell;
		text-align: center;
		vertical-align: middle;
		height: 80px;
	}
	#veloxcontain .borderless td
	{
		border: 0px;
		padding: 5px;
		border-bottom: 1px solid #707070;
	}
	#veloxcontain h1
	{
		font-weight: normal;
		color: #78ac41;
	}
	#veloxcontain h2
	{
		font-weight: 100;
		color: #78ac41;
		font-size: 1.15em;
		padding-bottom: 0;
		margin-bottom: 0;
	}
	#veloxcontain h3
	{
		font-weight: 600;
		color: #78ac41;
		font-size: 1.15em;
		padding-bottom: 0;
		margin-bottom: 0;
	}
	#veloxcontain h4
	{
		color: #78ac41;
		font-style: italic;
	}
	
	#veloxcontain strong, #veloxcontain b {
		color: #78ac41!important;
	}
	#veloxcontain .indent,
	#veloxcontain .indent li
	{
		padding-left: 20px;
	}
	#veloxcontain .section
	{
		font-weight:bold;
		font-size: 0.5em;
		color: #78ac41;
	}
	#veloxcontain .variable
	{
		width: 200px;
	}
	#veloxcontain .outerElement
	{
		font-weight: bold;
		color: #78ac41;
		background-color: #f5f5f5;
	}
	#veloxcontain .value
	{
		font-style: italic;
	}
	#veloxcontain .cart_filename
	{
		font-weight: bold;
		color: #78ac41;
	}
	#veloxcontain #back,
	#veloxcontain .back-to-top
	{
		float: right;
		margin-right: 25%;
	}
	#veloxcontain .footnotes,
	#veloxcontain .footnotes td,
	#veloxcontain .footnotes tr
	{
		border: 0;
	}

	#veloxcontain .footnotes-left
	{
		width: 32px;
	}

	#veloxcontain #cart_link,
	#veloxcontain #cart_link img
	{
		text-decoration: none;
		border: none;
	}
	#veloxcontain .allowed
	{
		font-size: 0.75em;
		color: #505050;
	}
	#veloxcontain .callout
	{
		color: #78ac41;
	}
	#veloxcontain .header h1
	{
		color: #78ac41;
	}
	#veloxcontain pre
	{
		white-space: pre-wrap;
	}
	#integration_overview {
		visibility:hidden;
	}
	
	
	pre code {
	  display: block;
	  padding: 0.5em;
	  background-color: #f4f4f4;
	  font-size: 0.975em;
	}

	pre code,
	pre .subst,
	pre .lisp .title,
	pre .clojure .built_in {
	  color: black;
	}

	pre .string,
	pre .title,
	pre .parent,
	pre .tag .value,
	pre .rules .value,
	pre .rules .value .number,
	pre .preprocessor,
	pre .ruby .symbol,
	pre .ruby .symbol .string,
	pre .aggregate,
	pre .template_tag,
	pre .django .variable,
	pre .smalltalk .class,
	pre .addition,
	pre .flow,
	pre .stream,
	pre .bash .variable,
	pre .apache .cbracket {
	  color: #050;
	}

	pre .comment,
	pre .annotation,
	pre .template_comment,
	pre .diff .header,
	pre .chunk {
	  color: #777;
	}

	pre .number,
	pre .date,
	pre .regexp,
	pre .literal,
	pre .smalltalk .symbol,
	pre .smalltalk .char,
	pre .change,
	pre .tex .special {
	  color: #800;
	}

	pre .label,
	pre .javadoc,
	pre .ruby .string,
	pre .decorator,
	pre .filter .argument,
	pre .localvars,
	pre .array,
	pre .attr_selector,
	pre .pseudo,
	pre .pi,
	pre .doctype,
	pre .deletion,
	pre .envvar,
	pre .shebang,
	pre .apache .sqbracket,
	pre .nginx .built_in,
	pre .tex .formula,
	pre .prompt,
	pre .clojure .attribute {
	  color: #00e;
	}

	pre .keyword,
	pre .id,
	pre .phpdoc,
	pre .title,
	pre .built_in,
	pre .aggregate,
	pre .smalltalk .class,
	pre .winutils,
	pre .bash .variable,
	pre .apache .tag,
	pre .xml .tag,
	pre .tex .command,
	pre .request,
	pre .status {
	  font-weight: bold;
	  color: navy;
	}

	pre .nginx .built_in {
	  font-weight: normal;
	}

	pre .coffeescript .javascript,
	pre .javascript .xml,
	pre .tex .formula,
	pre .xml .javascript,
	pre .xml .vbscript,
	pre .xml .css,
	pre .xml .cdata {
	  opacity: 0.5;
	}

	/* --- */
	pre .apache .tag {
	  font-weight: bold;
	  color: blue;
	}
	
	
	ul.index {
		padding:0;
		margin:0;
		list-style:none;
	}

	ul.index li {
		display:inline-block;
		width:23%;
		margin-right:1%;
		margin-bottom:10px;
		background:#78ac41;
		color:#fff;
		text-align:center;
		vertical-align:top;
		font-size:12px;
		padding:10px;
		cursor:pointer;

	}
	ul.index li a, ul.index li a:hover, ul.index li a:active{
		color:#fff;
		text-decoration:none;
	}
	ul.index p{
		height:30px;
		margin-bottom:0px;
		margin-top:5px;
		font-size:14px;
		line-height:15px;
		text-transform:uppercase;

	}
	ul.index .iconimage img{
		width:100px;
		height:100px;
		display:inline-block;
		margin-bottom:10px;
		margin-top:10px;
	}
	
	.borderless tbody>tr td:last-child {
		word-wrap: break-word;
		word-break: break-all;
		white-space: normal;
	}
	
	@media (max-width:768px){
		#veloxcontain #sidebar {
			float: inherit;
			position: relative;
			left: 0;
			width: 100%;
			z-index: 999;
		}

		#veloxcontain .current_content, #veloxcontain .content {
			width: 100%;
			max-width: 920px;
			page-break-after: always;
			margin-left:0px;
			margin-top:20px
		}

		#veloxcontain table th, #veloxcontain table td{
			word-break: break-all;
			width:auto!important;
			min-width:80px;
		}

		ul.index li {
			display: inline-block;
			width: 48%;
			margin-right: 1%;
			margin-bottom: 10px;
			background: #78ac41;
			color: #fff;
			text-align: center;
			vertical-align: top;
			font-size: 12px;
			padding: 10px;
			cursor: pointer;
		}

		ul.index p {
			height: 30px;
			margin-bottom: 0px;
			margin-top: 5px;
			font-size: 11px;
			line-height: 15px;
			text-transform: uppercase;
		}
		
		#veloxcontain pre {
			white-space: pre-wrap;
			word-break: break-word;
		}

	}

</style>
<div style="text-align:left; margin-bottom: 20px;">
	<img src="http://www.360.mpymnt.com/sites/default/files/360logo.png" style="width:150px; height:auto;" />
</div>
<div id="veloxcontain" class="veloxcontain clearfix">
	<?php 
	$url = 'https://velox.transactiongateway.com/merchants/resources/integration/integration_portal.php?tid=02ddb046e06b8f71c8b6b3a39fb70435';
	
	$content = file_get_contents($url);
	$content = str_replace("<html>", "", $content);
	$content = str_replace("</html>", "", $content);
	$content = str_replace("<!DOCTYPE HTML>", "", $content);
	$content = str_replace("<body>", "", $content);
	$content = str_replace("</body>","", $content);
	$content = str_replace("color:red;","", $content);
	$content = str_replace("font-weight:bold;","font-weight:bold; color:#78ac41!important;", $content);
		$content = str_replace("font-weight:bold","font-weight:bold; color:#78ac41!important;", $content);
	$content = preg_replace('/<head>(.*)<\/head>/iUs', '', $content);
	//$regex = '#(<head>)\s?(.*)?\s?(<\/head>)#';
    //$content = preg_replace($regex,'', $content);
	//preg_replace('/(<link\b.+href=")(?!http)([^"]*)(".*>)/', '', $content);
	$content = str_replace("download.php?document", "https://velox.transactiongateway.com/merchants/resources/integration/download.php?document", $content);
	
	echo $content;
	
	?>
</div>

<div id="intro" style="display:none;">
		<h1>Welcome to the Developer Portal!</h1>
		<p>Velox takes care of payments, so you can focus on what you do best!</p>
		<p>This portal guides you through a complete integration of Velox into your POS system, starting from the first test transaction and all the way to going live.</p>
		
		<ul class="index">
			<li>
				<a href="#integration_overview" class="introa">
					<span class="iconimage img1"><img src="http://www.360paymentsolutions.com/wp-content/uploads/2017/03/007-round.png" /></span>
					<p>Integration Overview</p>
				</a>
			</li>
			
			<li>
				<a href="#3step_methodology" class="introa">
					<span class="iconimage img2"><img src="http://www.360paymentsolutions.com/wp-content/uploads/2017/03/008-shapes.png" /></span>
					<p>Three Step Redirect API</p>
				</a>
			</li>
			
			<li>
				<a href="#methodology" class="introa">
					<span class="iconimage img3"><img src="http://www.360paymentsolutions.com/wp-content/uploads/2017/03/005-marketing.png" /></span>
					<p>Direct Post API</p>
				</a>
			</li>
			
			<li>
				<a href="#query_methodology" class="introa">
					<span class="iconimage img4"><img src="http://www.360paymentsolutions.com/wp-content/uploads/2017/03/006-multimedia.png" /></span>
					<p>Query API</p>
				</a>
			</li>
			
			<li>
				<a href="#mobile_methodology" class="introa">
					<span class="iconimage img5"><img src="http://www.360paymentsolutions.com/wp-content/uploads/2017/03/004-technology.png" /></span>
					<p>Mobile SDK</p>
				</a>
			</li>
			
			<li>
				<a href="#emv_methodology" class="introa">
					<span class="iconimage img6"><img src="http://www.360paymentsolutions.com/wp-content/uploads/2017/03/003-commerce-1.png" /></span>
					<p>EMV Chip Card SDK</p>
				</a>
			</li>
			
			<li>
				<a href="#quickclick_methodology" class="introa">
					<span class="iconimage img7"><img src="http://www.360paymentsolutions.com/wp-content/uploads/2017/03/002-commerce.png" /></span>
					<p>QuickClick Shopping Cart</p>
				</a>
			</li>
			
			<li>
				<a href="#carts_list" class="introa">
					<span class="iconimage img8"><img src="http://www.360paymentsolutions.com/wp-content/uploads/2017/03/001-shopping.png" /></span>
					<p>Third Party Shopping Carts</p>
				</a>
			</li>
		
		
		</ul>
</div>

<script>
	jQuery(function($){
		var intro = $("#intro").html();
		$("#integration_overview").html(intro);
		$("#integration_overview").css('visibility', 'visible');
	});
	
	jQuery(document).ready(function($){
		
		function hashChanged(hash) {
			$(".current_content").toggleClass("content").toggleClass("current_content");
			$(hash).toggleClass("content").toggleClass("current_content");
			$(".active").toggleClass("active");
			$("a[href='" + hash + "']").toggleClass("active");
		}
		if (window.location.hash) {
			hashChanged(window.location.hash);
		}
		if ("onhashchange" in window) {
			window.onhashchange = function() {
				hashChanged(window.location.hash);
			}
		} else {
			var storedHash = window.location.hash;
			window.setInterval(function() {
				if (window.location.hash != storedHash) {
					storedHash = window.location.hash;
					hashChanged(storedHash);
				}
			}, 100);
		}
		$(".view > a").click(function() {
			$(".active").toggleClass("active");
			$(this).toggleClass("active");
		});
		$(".folder > a.expanded + ul").slideToggle("fast");
		$(".folder > a").click(function() {
			if (!$(this).hasClass("expanded")) {
				$(".folder > a.expanded").toggleClass("expanded").toggleClass("collapsed").parent().find('> ul').slideToggle("fast");
			}
			$(this).toggleClass("expanded").toggleClass("collapsed").parent().find('> ul').slideToggle("fast");
		});
		$(".subfolder > a.expanded + ul").slideToggle("fast");
		$(".subfolder > a").click(function() {
			$(this).toggleClass("expanded").toggleClass("collapsed").parent().find('> ul').slideToggle("fast");
		});
		$(".menu_link").click(function(e) {
			var section = $(this).attr("href");
			if (section.charAt(0) == "#") {
				
				if($( window ).width()>768){
					e.preventDefault();
					$(window).scrollTop(0);
				}
				$(".current_content").toggleClass("content").toggleClass("current_content");
				$(section).toggleClass("content").toggleClass("current_content");
				
			}
		});
		
		
	});


</script>
<script type="text/javascript" src="https://velox.transactiongateway.com/contrib/js/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<?php get_footer();

/* Omit closing PHP tag to avoid "Headers already sent" issues. */