<?
# $Id$
#
# Copyright (c) 2005 John Peterson
#
# Permission is hereby granted, free of charge, to any person obtaining
# a copy of this software and associated documentation files (the
# "Software"), to deal in the Software without restriction, including
# without limitation the rights to use, copy, modify, merge, publish,
# distribute, sublicense, and/or sell copies of the Software, and to
# permit persons to whom the Software is furnished to do so, subject to
# the following conditions:
#
# The above copyright notice and this permission notice shall be
# included in all copies or substantial portions of the Software.
#
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
# EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
# MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
# NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
# LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
# OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
# WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

class Helpers {

    function __construct() {
        $this->controller_name = $GLOBALS['current_controller_name'];
        $this->controller_path = $GLOBALS['current_controller_path'];
    }

    function tag_options($options) {
        if(count($options)) {
            $html = array();
            foreach($options as $key => $value) {
                $html[] = "$key = \"".htmlspecialchars($value, ENT_QUOTES)."\"";
            }
            sort($html);
            $html = implode(" ", $html);
        }
        return $html;
    }

    # Examples:
    # * <tt>tag("br") => <br /></tt>
    # * <tt>tag("input", { "type" => "text"}) => <input type="text" /></tt>
    function tag($name, $options = array(), $open = false) {
        $html = "<$name ";
        $html .= $this->tag_options($options);
        $html .= $open ? ">" : " />";
        return $html;
    }

    # Examples:
    # * <tt>content_tag("p", "Hello world!") => <p>Hello world!</p></tt>
    # * <tt>content_tag("div", content_tag("p", "Hello world!"), "class" => "strong") => </tt>
    #   <tt><div class="strong"><p>Hello world!</p></div></tt>
    function content_tag($name, $content, $options = array()) {
        $html .= "<$name ";
        $html .= $this->tag_options($options);
        $html .= ">$content</$name>";
        return $html;
    }

}

?>