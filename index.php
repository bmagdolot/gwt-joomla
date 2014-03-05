<?php defined('_JEXEC') or die;
// Load template framework 
include_once JPATH_THEMES . '/' . $this->template . '/framework.php'; 
?>

<?php

defined('_JEXEC') or die;

$doc = JFactory::getDocument();

$doc->addStyleSheet('templates/' . $this->template . '/css/foundation.css');
$doc->addStyleSheet('templates/' . $this->template . '/css/style.css');

$doc->addScript('templates/' . $this->template . '/js/vendor/custom.modernizr.js', 'text/javascript');
JHtml::_('jquery.framework');


$option = JFactory::getApplication()->input->getVar('option');
$view = JFactory::getApplication()->input->getVar('view');
// Make sure it is a single article
if ($option == 'com_content' && $view == 'article'):
  $id = JFactory::getApplication()->input->getInt('id');
  $article = JTable::getInstance('content');
  $article->load($id);
  $author_id = $article->created_by;
  $user = JFactory::getUser($author_id);

  $article_title = $article->get('title');
  $article_created = $article->created;

  $article_alias = $article->get('alias');
  $article_introtext = $article->get('introtext');
  $article_fulltext = $article->get('fulltext');
  $author = $user->name;

  $db = &JFactory::getDBO();
  $id = JRequest::getString('id');
  $db->setQuery('SELECT #__categories.title FROM #__content, #__categories WHERE #__content.catid = #__categories.id AND #__content.id = '.$id);
  $category = $db->loadResult();
endif;

// Logo
$logoPosition = ($this->params->get('logoPosition') == 0 ? 'left' : 'center');

if ($this->params->get('logoFile'))
{
  $logo = '<a href="'.$this->baseurl.'" style="background-position:top '.$logoPosition.'; background-image:url('.$this->params->get('logoFile').');">Agency Logo</a>';
}
else
{
  $logo = '<a href="'.$this->baseurl.'" style="background-position:top '.$logoPosition.';">Agency Logo</a>';
}

//if ($this->params->get('logoFilesmall'))
//{
//  $logosmall = '<a href="" style="background-position:top '.$logoPosition.'; background-image:url('.$this->params->get('logoFilesmall').');">Logo Small</a>';
//}
//elseif ($this->params->get('logoFile'))
//{
//	$logosmall = '<a href="" style="background-position:top '.$logoPosition.'; background-//image:url('.$this->params->get('logoFile').');">Logo Small</a>';
//}
//else
//{
//  $logosmall = '<a href="" style="background-position:top '.$logoPosition.';">Logo Small/a>';
//}

if ($this->params->get('headerBackgroundImage'))
{
  $background = 'style="background-image:url('.$this->params->get('headerBackgroundImage').');background-position:right;"';
}
else
{
  $background = 'style="background-color:'.$this->params->get('headerBackgroundColor').';background-position:right;"';
}

if ($this->params->get('accessAccessibility'))
{  $accessibilityLink = '<a class="skips" href="'.$this->params->get('accessAccessibility').'" accesskey="0">Skip to Accessibility Instructions</a>';}
else
{  $accessibilityLink = '';}

if ($this->params->get('accessHome'))
{  $homeLink = '<a class="skips" href="'.$this->params->get('accessHome').'" accesskey="1">Skip to Home</a>';}
else
{  $homeLink = '';}

if ($this->params->get('accessContent'))
{  $contentLink = '<a class="skips" href="'.$this->params->get('accessContent').'" accesskey="R">Skip to Content</a>';}
else
{  $contentLink = '';}

if ($this->params->get('accessFAQ'))
{  $FAQLink = '<a class="skips" href="'.$this->params->get('accessFAQ').'" accesskey="5">Skip to FAQ</a>';}
else
{  $FAQLink = '';}

if ($this->params->get('accessContact'))
{  $contactLink = '<a class="skips" href="'.$this->params->get('accessContact').'" accesskey="C">Skip to Contact</a>';}
else
{  $contactLink = '';}

if ($this->params->get('accessFeedback'))
{  $feedbackLink = '<a class="skips" href="'.$this->params->get('accessFeedback').'" accesskey="K">Skip to Feedback</a>';}
else
{  $feedbackLink = '';}

if ($this->params->get('accessSiteMap'))
{  $sitemapLink = '<a class="skips" href="'.$this->params->get('accessSiteMap').'" accesskey="M">Skip to Site Map</a>';}
else
{  $sitemapLink = '';}

if ($this->params->get('accessSearch'))
{  $searchLink = '<a class="skips" href="'.$this->params->get('accessSearch').'" accesskey="S">Skip to Search</a>';}
else
{  $searchLink = '';}
?>

<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en" > <!--<![endif]-->

<head>
  <jdoc:include type="head" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    
<a class="skips" href="#maincontents">Skip to Content</a><a class="skips" href="#agencyfooter">Skip to Footer</a>
  <?php echo $accessibilityLink ?>
  <?php echo $homeLink ?>
  <?php echo $contentLink ?>
  <?php echo $FAQLink ?>
  <?php echo $contactLink ?>
  <?php echo $feedbackLink ?>
  <?php echo $sitemapLink ?>
  <?php echo $searchLink ?>

<!-- Header/Navigation -->
<?php include_once JPATH_THEMES . '/' . $this->template . '/layouts/header.php'; ?>
    
    <!-- Masthead/Agency logo -->
    <div class="container-masthead" <?php echo $background; ?>>
        <div class="row">
            <header class="large-12 columns">
                <h1 class="logo">
                    <?php echo $logo ?></h1>
            </header>
        </div>
    </div>
    <!-- END Masthead/Agency logo -->
   
<!-- Slider -->
<?php include_once JPATH_THEMES . '/' . $this->template . '/layouts/banner.php'; ?>
    
<!-- Auxiliary Menu / Breadcrumbs -->
  <?php if ($this->countModules('auxiliary-menu')): ?>
  	<div class="container-topbar nodisplay">
   		<div class="row" >
        	<nav class="top-bar nomargin">
            	<section class="top-bar-section">
                	<ul class="left">
                   	<li><jdoc:include type="modules" name="auxiliary-menu" style="none" /></li>
                    </ul>
              	</section>
       		</nav>
		</div>
  </div> 
  <?php else: ?>
  	<div></div>
  <?php endif ?>
  
    <?php if ($this->countModules('breadcrumb')): ?>
  	<div class="container-breadcrumb nodisplay">
   		<div class="row">
            	<section class="breadcrumbs">
            		<ul>
                	    <li><jdoc:include type="modules" name="breadcrumb" /></li>
                	</ul>
              	</section>	
       		</nav>
		</div>
  </div> 
  <?php else: ?>
  	<div></div>
  <?php endif ?>




  <div id="container-main" class="container-main" role="document">

    <div id="main" class="row">
<?php if ($this->params->get('sidebarPosition') == 3): ?>
       <aside id="sidebar" class="large-3 columns" role="complementary">
        <div class="sidebar-box">
          <div class="section-container auto" data-section>
            <section>
              <jdoc:include type="modules" name="left-sidebar-panel1" style="xhtml" />
            </section>
            <section>
              <jdoc:include type="modules" name="left-sidebar-panel2" style="xhtml" />
            </section>
            <section>
              <jdoc:include type="modules" name="left-sidebar-panel3" style="xhtml" />
            </section>
          </div>
        </div>
      </aside>
      <div id="content" class="large-6 columns" role="main">
        <a name="maincontents"></a>
        <div class="post-box">
          <jdoc:include type="message" style="xhtml" />
          <jdoc:include type="component" style="xhtml" />
        </div>
      </div>
      <aside id="sidebar" class="large-3 columns" role="complementary">
        <div class="sidebar-box">
          <div class="section-container auto" data-section>
            <section>
              <jdoc:include type="modules" name="right-sidebar-panel1" style="xhtml" />
            </section>
            <section>
              <jdoc:include type="modules" name="right-sidebar-panel2" style="xhtml" />
            </section>
            <section>
              <jdoc:include type="modules" name="right-sidebar-panel3" style="xhtml" />
            </section>
          </div>
        </div>
      </aside>
<?php elseif ($this->params->get('sidebarPosition') == 2): ?>
      <div id="content" class="large-12 columns" role="main">
        <a name="maincontents"></a> 
        <div class="post-box">
          <jdoc:include type="message" style="xhtml" />
          <jdoc:include type="component" style="xhtml" />
        </div>
      </div>
<?php elseif ($this->params->get('sidebarPosition') == 1): ?>
      <div id="content" class="large-8 columns" role="main">
        <a name="maincontents"></a>
        <div class="post-box">
          <jdoc:include type="message" style="xhtml" />
          <jdoc:include type="component" style="xhtml" />
        </div>
      </div>

      <aside id="sidebar" class="large-4 columns" role="complementary">
        <div class="sidebar-box">
          <div class="section-container auto" data-section>
            <section>
              <jdoc:include type="modules" name="right-sidebar-panel1" style="xhtml" />
            </section>
            <section>
              <jdoc:include type="modules" name="right-sidebar-panel2" style="xhtml" />
            </section>
            <section>
              <jdoc:include type="modules" name="right-sidebar-panel3" style="xhtml" />
            </section>
          </div>
        </div>
      </aside>
<?php else: ?>
       <aside id="sidebar" class="large-4 columns" role="complementary">
        <div class="sidebar-box">
          <div class="section-container auto" data-section>
            <section>
              <jdoc:include type="modules" name="left-sidebar-panel1" style="xhtml" />
            </section>
            <section>
              <jdoc:include type="modules" name="left-sidebar-panel2" style="xhtml" />
            </section>
            <section>
              <jdoc:include type="modules" name="left-sidebar-panel3" style="xhtml" />
            </section>
          </div>
        </div>
      </aside>

      <div id="content" class="large-8 columns" role="main">
          <a name="maincontents"></a>
        <div class="post-box">
          <jdoc:include type="message" style="xhtml" />
          <jdoc:include type="component" style="xhtml" />
        </div>
      </div>
<?php endif ?>

    </div>
  </div>




<!-- Agency & Standard Footer -->
<?php include_once JPATH_THEMES . '/' . $this->template . '/layouts/footer.php'; ?>


  <script src="<?php echo 'templates/' . $this->template . '/js/foundation.min.js'; ?>"></script>
  <script src="<?php echo 'templates/' . $this->template . '/js/custom.js'; ?>"></script>

  <script>
  document.write('<script src=' +
  ('__proto__' in {} ? 'templates/gwt-joomla-gwt-joomla-2.2.3/js/vendor/zepto' : 'templates/gwt-joomla-gwt-joomla-2.2.3/js/vendor/jquery') +
  '.js><\/script>')
  </script>
  
  <script src="js/foundation.min.js"></script>
  
  <script src="js/foundation/foundation.js"></script>
  
  <script src="js/foundation/foundation.alerts.js"></script>
  
  <script src="js/foundation/foundation.clearing.js"></script>
  
  <script src="js/foundation/foundation.cookie.js"></script>
  
  <script src="js/foundation/foundation.dropdown.js"></script>
  
  <script src="js/foundation/foundation.forms.js"></script>
  
  <script src="js/foundation/foundation.joyride.js"></script>
  
  <script src="js/foundation/foundation.magellan.js"></script>
  
  <script src="js/foundation/foundation.orbit.js"></script>
                                                    
  <script src="js/foundation/foundation.orbit.fullwidth.js"></script>    
                                                 
  <script src="js/foundation/foundation.reveal.js"></script>
  
  <script src="js/foundation/foundation.section.js"></script>
  
  <script src="js/foundation/foundation.tooltips.js"></script>
  
  <script src="js/foundation/foundation.topbar.js"></script>
  
  <script src="js/foundation/foundation.interchange.js"></script>
  
  <script src="js/foundation/foundation.placeholder.js"></script>
  
  <script src="js/foundation/foundation.abide.js"></script>

  <!-- animation: slide or fade -->
  <script>
    jQuery(document).foundation('', {
		animation: 'fade', 
		timer_speed: 5000,
		pause_on_hover: true,
		resume_on_mouseout: true,
		animation_speed: 1000,
		navigation_arrows: true,
		slide_number: true,
        next_class: 'orbit-next', 
        prev_class: 'orbit-prev',
		timer_container_class: 'orbit_timer',
		bullets: true,
        circular: true,
        timer: true,
		variable_height: true,
	});
  </script>

  



</body>
</html>
width="280" height="280"></div>
      </div></article><article id="text-10" class="widget widget_text"><div class="footer-section"> <div class="textwidget"><p style="text-align:center;">All content is public domain unless otherwise stated.</p></div>
      </div></article>
      </div>

    <div class="large-3 columns widget-area pull-4" role="complementary">
      <article id="nav_menu-3" class="widget widget_nav_menu"><div class="footer-section"><h6><strong>Republic of the Philippines</strong></h6><div class="menu-national-government-portal-container"><ul id="menu-national-government-portal" class="menu"><li id="menu-item-786" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-786"><a href="http://www.gov.ph">Official Gazette</a></li>
      <li id="menu-item-787" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-787"><a href="http://president.gov.ph">Office of the President</a></li>
      <li id="menu-item-3236" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3236"><a href="http://www.gov.ph/directory/">Official Directory</a></li>
      <li id="menu-item-3235" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3235"><a href="http://www.gov.ph/calendar/">Official Calendar</a></li>
      </ul></div></div></article><article id="nav_menu-7" class="widget widget_nav_menu"><div class="footer-section"><h6><strong>Resources</strong></h6><div class="menu-links-resources-container"><ul id="menu-links-resources" class="menu"><li id="menu-item-3294" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3294"><a href="http://noah.dost.gov.ph/">Project NOAH</a></li>
      </ul></div></div></article>
    </div>

    <div class="large-3 columns widget-area pull-6" role="complementary">
      <article id="nav_menu-4" class="widget widget_nav_menu"><div class="footer-section"><h6><strong>Executive</strong></h6><div class="menu-links-executive-container"><ul id="menu-links-executive" class="menu"><li id="menu-item-3237" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3237"><a href="http://www.president.gov.ph">Office of the President</a></li>
      <li id="menu-item-3238" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3238"><a href="http://www.ovp.gov.ph">Office of the Vice President</a></li>
      <li id="menu-item-3239" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3239"><a href="http://www.deped.gov.ph">Department of Education</a></li>
      <li id="menu-item-3241" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3241"><a href="http://www.dilg.gov.ph">Department of Interior and Local Government</a></li>
      <li id="menu-item-3240" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3240"><a href="http://www.dof.gov.ph">Department of Finance</a></li>
      <li id="menu-item-3242" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3242"><a href="http://www.doh.gov.ph">Department of Health</a></li>
      <li id="menu-item-3293" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3293"><a href="http://www.dost.gov.ph/">Department of Science and Technology</a></li>
      <li id="menu-item-3296" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3296"><a href="http://www.dti.gov.ph/">Department of Trade and Industry</a></li>
      </ul></div></div></article><article id="nav_menu-6" class="widget widget_nav_menu"><div class="footer-section"><h6><strong>Legislative</strong></h6><div class="menu-links-legislative-container"><ul id="menu-links-legislative" class="menu"><li id="menu-item-3248" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3248"><a href="http://www.senate.gov.ph/">Senate of the Philippines</a></li>
      <li id="menu-item-3249" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3249"><a href="http://www.congress.gov.ph/">House of Representatives</a></li>
      </ul></div></div></article><article id="nav_menu-5" class="widget widget_nav_menu"><div class="footer-section"><h6><strong>Judiciary</strong></h6><div class="menu-links-judiciary-container"><ul id="menu-links-judiciary" class="menu"><li id="menu-item-3243" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3243"><a href="http://sc.judiciary.gov.ph/">Supreme Court</a></li>
      <li id="menu-item-3244" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3244"><a href="http://ca.judiciary.gov.ph/">Court of Appeals</a></li>
      <li id="menu-item-3245" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3245"><a href="http://sb.judiciary.gov.ph/">Sandiganbayan</a></li>
      <li id="menu-item-3246" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3246"><a href="http://cta.judiciary.gov.ph/">Court of Tax Appeals</a></li>
      <li id="menu-item-3247" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3247"><a href="http://jbc.judiciary.gov.ph/">Judicial Bar and Council</a></li>
      </ul></div></div></article>
    </div>
    </div>
  </div>

  <script>
  document.write('<script src=' +
  ('__proto__' in {} ? 'templates/uwcp/js/vendor/zepto' : 'templates/uwcp/js/vendor/jquery') +
  '.js><\/script>')
  </script>


  <script src="<?php echo 'templates/' . $this->template . '/js/foundation.min.js'; ?>"></script>
  <script src="<?php echo 'templates/' . $this->template . '/js/custom.js'; ?>"></script>

  <!--
  <script src="templates/uwcp/js/foundation/foundation.js"></script>

  <script src="templates/uwcp/js/foundation/foundation.alerts.js"></script>

  <script src="templates/uwcp/js/foundation/foundation.clearing.js"></script>

  <script src="templates/uwcp/js/foundation/foundation.cookie.js"></script>

  <script src="templates/uwcp/js/foundation/foundation.dropdown.js"></script>

  <script src="templates/uwcp/js/foundation/foundation.forms.js"></script>

  <script src="templates/uwcp/js/foundation/foundation.joyride.js"></script>

  <script src="templates/uwcp/js/foundation/foundation.magellan.js"></script>

  <script src="templates/uwcp/js/foundation/foundation.orbit.js"></script>

  <script src="templates/uwcp/js/foundation/foundation.placeholder.js"></script>

  <script src="templates/uwcp/js/foundation/foundation.reveal.js"></script>

  <script src="templates/uwcp/js/foundation/foundation.section.js"></script>

  <script src="templates/uwcp/js/foundation/foundation.tooltips.js"></script>

  <script src="templates/uwcp/js/foundation/foundation.topbar.js"></script>

  <script src="templates/uwcp/js/foundation/foundation.interchange.js"></script>
  -->
  <script>
    jQuery(document).foundation();
  </script>
</body>
</html>
