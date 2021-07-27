<?php
if (!extension_loaded("pthreads")) {

	interface Collectable {
	    /* Determine whether an object has been marked as garbage */
		public function isGarbage() : bool;
	}
}
