<?php
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'theantichris\\iCalendarCreator\\Location' => '/Location.php',
                'theantichris\\iCalendarCreator\\iCalendar' => '/iCalendar.php',
                'theantichris\\iCalendarCreator\\iCalendarCreator' => '/iCalendarCreator.php',
            );
        }

        if (isset($classes[$class])) {
            require __DIR__ . $classes[$class];
        }
    }
);