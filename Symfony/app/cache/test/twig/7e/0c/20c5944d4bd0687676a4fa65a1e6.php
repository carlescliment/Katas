<?php

/* DCTenisBundle:Game:index.html.twig */
class __TwigTemplate_7e0c20c5944d4bd0687676a4fa65a1e6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<h1>Start a new game</h1>

<a id=\"start-game\" href=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("create_game"), "html", null, true);
        echo "\">Start</a>
";
    }

    public function getTemplateName()
    {
        return "DCTenisBundle:Game:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 3,  17 => 1,);
    }
}
