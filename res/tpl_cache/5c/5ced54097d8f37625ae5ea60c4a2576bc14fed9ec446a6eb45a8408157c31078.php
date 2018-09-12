<?php

/* add_image.html */
class __TwigTemplate_a2a2ad4c7c2ab6df99004a4519694e49b124dc578441c9fb26657acc2bd04e7a extends Twig_Template
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
        echo "<!DOCTYPE html>

<html lang=\"en\">
    <head>
        <title>TODO supply a title</title>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <style>
            form {
                width: 5em;
                margin-top: 10px;
            }
            input{
                margin: 5px;
            }

          .notif {
            color: green;
          }

          .err {
            color: red;
          }
        </style>
    </head>
    <body>
\t";
        // line 27
        echo twig_include($this->env, $context, "nav.html");
        echo "
        ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["errors"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
            // line 29
            echo "  <p class=\"err\">";
            echo twig_escape_filter($this->env, $context["error"], "html", null, true);
            echo "</p>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo " ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["notifications"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["notification"]) {
            // line 31
            echo "  <p class=\"notif\">";
            echo twig_escape_filter($this->env, $context["notification"], "html", null, true);
            echo "</p>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['notification'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "        <div><form method=\"post\" action=\"/add-image/\" enctype=\"multipart/form-data\">
                <label>Add image</label>
                <input type=\"file\" name=\"image\">
                <input type=\"submit\" >
                    
            </form></div>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "add_image.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 33,  73 => 31,  68 => 30,  59 => 29,  55 => 28,  51 => 27,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "add_image.html", "C:\\xampp\\htdocs\\testSakhCom\\res\\views\\add_image.html");
    }
}
