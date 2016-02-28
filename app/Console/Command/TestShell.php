<?php
class TestShell extends AppShell {
     public $uses = array('McCalltime');
 
    public function main() {
         $this->McCalltime->TestFunction();
    }
 
}
