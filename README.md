<h2>Installation Steps</h2>
<ol>
    <li>
        Make a directory in your working folder.
    </li>
    <li>
        goto created folder using command <b>cd folder name</b>
    </li>
    <li>
        Run Following Commands
        <ul>
            <li>
                <b>git init</b>
            </li>
            <li>
                <b>git remote add origin https://github.com/ishrat03/creditfair.git</b>
            </li>
            <li>
                <b>git pull origin main</b>
            </li>
             <li>
                <b>composer.phar install</b><br>
                If composer is not installed then follow <a href="https://getcomposer.org/">Composer Installation Steps</a> to install Composer.
            </li>
            <li>
                <b>npm install</b>
            </li>
        </ul>
    </li>
    <li>
        now rename .env.example to .env<br>
        Set your database credentials in .env file
    </li>
    <li>
        Create database if not created.
    </li>
    <li>
		run command <b>php artisan migrate</b>
    </li>
	<li>
		run command <b>php artisan db:seed --class=DatabaseSeeder</b>
    </li>
</ol>
<h2>Our Setting is completed now</h2>
<h5>Now run command php artisan serve</h5>
open your browser and open link <b>127.0.0.1:8000</b>
