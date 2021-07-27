<?php
if (!extension_loaded("pthreads")) {

	interface Collectable {
	    /* Determine whether an object has been marked as garbage */
		public function isGarbage();
		/* Mark an object as garbage */
		public function setGarbage();
	}
}
