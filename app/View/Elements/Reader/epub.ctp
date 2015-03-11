<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			echo $this->Html->charset();
			echo $this->Html->meta(array('http-equiv' => 'imagetoolbar', 'content' => 'no'));
			echo $this->Html->meta(array('name' => 'google', 'content' => 'notranslate'));
			echo $this->Html->meta('description', 'Read book ' . $book['Book']['title'] . '');
			echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'));
			echo $this->Html->meta('favicon.ico', '/favicon.ico', array('type' => 'icon'));

			echo $this->Html->css(array(
                'stylesheets/monocle/monocore.css',
                'stylesheets/monocle/monoctrl.css',
                'stylesheets/monocle/layout.css'
            ));

            echo $this->Html->script(array(
                'monocle/monocore.js',
                'monocle/monoctrl.js'
            ));

            echo $this->Html->scriptBlock(
                'Monocle.bookDataComponents = ' . $reader->getComponents() . ';'
                . 'Monocle.bookDataContents = ' . $reader->getContents() . ';'
                . 'Monocle.bookDataTitle = \'' . addslashes($book['Book']['title']) . '\';'
                . 'Monocle.bookDataTitle = \'' . addslashes($book['Book']['author_sort']) . '\';'
            );

            echo $this->Html->script('monocle/layout.js');
		?>
		<title><?php echo $book['Book']['title']; ?></title>
	</head>
	<body>
        <div id="readerBg">
            <div class="board"></div>
            <div class="jacket"></div>
            <div class="dummyPage"></div>
            <div class="dummyPage"></div>
            <div class="dummyPage"></div>
            <div class="dummyPage"></div>
            <div class="dummyPage"></div>
        </div>
        <div id="readerCntr">
            <div id="reader"></div>
        </div>
	</body>
</html>