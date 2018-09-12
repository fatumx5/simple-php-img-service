<?php

/* nav.html */
class __TwigTemplate_06452fb4d931c68eec710306e2977da80b630fefb929b26025129d4ee83e994d extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"nav\">
      |<a href=\"/\"> Home </a>|<a href=\"/auth/sign-up\">SignUp </a>|
      <a href=\"/auth/login\">login </a>|<a href=\"/auth/logout\">logout </a>|
      <a href=\"/add-image\">Add Image </a>|

    </div>";
    }

    public function getTemplateName()
    {
        return "nav.html";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "nav.html", "C:\\xampp\\htdocs\\testSakhCom\\res\\views\\nav.html");
    }
}
