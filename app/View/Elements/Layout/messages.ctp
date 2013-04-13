<div class="message-container">
	<?php
		/**
		 * Flash Messages
		 */
			echo $this->Session->flash();
			echo $this->Session->flash('auth');
			echo $this->Session->flash('email');
	?>
</div>