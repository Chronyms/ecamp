<?php
/**
 * PHPTAL templating engine
 *
 * PHP Version 5
 *
 * @category HTML
 * @package  PHPTAL
 * @author   Laurent Bedubourg <lbedubourg@motion-twin.com>
 * @author   Kornel Lesiński <kornel@aardvarkmedia.co.uk>
 * @license  http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @version  SVN: $Id$
 * @link     http://phptal.org/
 */

/**
 * node that represents element's attribute
 *
 * @package PHPTAL
 * @subpackage Dom
 */
class PHPTAL_Dom_Attr
{
    private $value_escaped;
    private $qualified_name;
    private $namespace_uri;
    private $encoding;
    /**
     * attribute's value can be overriden with a variable
     */
    private $phpVariable;
    const HIDDEN = -1;
    const NOT_REPLACED = 0;
    const VALUE_REPLACED = 1;
    const FULLY_REPLACED = 2;
    private $replacedState = 0;

    /**
     * @param string $qualified_name attribute name with prefix
     * @param string $namespace_uri full namespace URI or empty string
     * @param string $value_escaped value with HTML-escaping
     * @param string $encoding character encoding used by the value
     */
    public function __construct($qualified_name, $namespace_uri, $value_escaped, $encoding)
    {
        $this->value_escaped = $value_escaped;
        $this->qualified_name = $qualified_name;
        $this->namespace_uri = $namespace_uri;
        $this->encoding = $encoding;
    }

    /**
     * get character encoding used by this attribute.
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * get full namespace URI. "" for default namespace.
     */
    public function getNamespaceURI()
    {
        return $this->namespace_uri;
    }

    /**
     * get attribute name including namespace prefix, if any
     */
    public function getQualifiedName()
    {
        return $this->qualified_name;
    }

    /**
     * get "foo" of "ns:foo" attribute name
     */
    public function getLocalName()
    {
        $n = explode(':', $this->qualified_name, 2);
        return end($n);
    }

    /**
     * Returns true if this attribute is ns declaration (xmlns="...")
     *
     * @return bool
     */
    public function isNamespaceDeclaration()
    {
        return preg_match('/^xmlns(?:$|:)/', $this->qualified_name);
    }


    /**
     * get value as plain text
     *
     * @return string
     */
    public function getValue()
    {
        return html_entity_decode($this->value_escaped, ENT_QUOTES, $this->encoding);
    }

    /**
     * set plain text as value
     */
    public function setValue($val)
    {
        $this->value_escaped = htmlspecialchars($val, ENT_QUOTES, $this->encoding);
    }

    /**
     * Depends on replaced state.
     * If value is not replaced, it will return it with HTML escapes.
     *
     * @see getReplacedState()
     * @see overwriteValueWithVariable()
     */
    public function getValueEscaped()
    {
        return $this->value_escaped;
    }

    /**
     * Set value of the attribute to this exact string.
     * String must be HTML-escaped and use attribute's encoding.
     *
     * @param string $value_escaped new content
     */
    public function setValueEscaped($value_escaped)
    {
        $this->replacedState = self::NOT_REPLACED;
        $this->value_escaped = $value_escaped;
    }

    /**
     * set PHP code as value of this attribute. Code is expected to echo the value.
     */
    private function setPHPCode($code)
    {
        $this->value_escaped = '<?php '.$code." ?>\n";
    }

    /**
     * hide this attribute. It won't be generated.
     */
    public function hide()
    {
        $this->replacedState = self::HIDDEN;
    }

    /**
     * generate value of this attribute from variable
     */
    public function overwriteValueWithVariable($phpVariable)
    {
        $this->replacedState = self::VALUE_REPLACED;
        $this->phpVariable = $phpVariable;
        $this->setPHPCode('echo '.$phpVariable);
    }

    /**
     * generate complete syntax of this attribute using variable
     */
    public function overwriteFullWithVariable($phpVariable)
    {
        $this->replacedState = self::FULLY_REPLACED;
        $this->phpVariable = $phpVariable;
        $this->setPHPCode('echo '.$phpVariable);
    }

    /**
     * use any PHP code to generate this attribute's value
     */
    public function overwriteValueWithCode($code)
    {
        $this->replacedState = self::VALUE_REPLACED;
        $this->phpVariable = null;
        $this->setPHPCode($code);
    }

    /**
     * if value was overwritten with variable, get its name
     */
    public function getOverwrittenVariableName()
    {
        return $this->phpVariable;
    }

    /**
     * whether getValueEscaped() returns real value or PHP code
     */
    public function getReplacedState()
    {
        return $this->replacedState;
    }
}
