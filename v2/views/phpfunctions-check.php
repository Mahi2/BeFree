<?php
require("core.php");
head();
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">
				
				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-check"></i> PHP Functions - Security Check</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">PHP Functions - Security Check</li>
        		      </ol>
        		    </div>
        		  </div>
    			</div>
            </div>

				<!--Page content-->
				<!--===================================================-->
				<div class="content">
				<div class="container-fluid">

                <div class="row">
				<div class="col-md-9">

							    <div class="card">
								<div class="card-header">
								<ul class="nav nav-tabs card-header-tabs">
									<li class="nav-item active">
										<a href="#f1" data-toggle="tab" class="nav-link active text-center">Command Execution</a>
									</li>
									<li class="nav-item">
										<a href="#f2" data-toggle="tab" class="nav-link text-center">PHP Code Execution</a>
									</li>
									<li class="nav-item">
										<a href="#f3" data-toggle="tab" class="nav-link text-center">Information Disclosure</a>
									</li>
									<li class="nav-item">
										<a href="#f4" data-toggle="tab" class="nav-link text-center">Filesystem Functions</a>
									</li>
									<li class="nav-item">
										<a href="#f5" data-toggle="tab" class="nav-link text-center">Other</a>
									</li>			
								</ul>
								</div>
								<div class="card-body">
								<div class="tab-content">
									<div id="f1" class="tab-pane fade active show">
									    <div class="card card-body bg-light">Executing commands and returning the complete output</div><br />
										    <div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> exec &nbsp;&nbsp;
<?php
if (function_exists('exec')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>
                                                <br /><br /><pre class="breadcrumb">Returns last line of commands output</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> passthru &nbsp;&nbsp;
<?php
if (function_exists('passthru')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>
                                                <br /><br /><pre class="breadcrumb">Passes commands output directly to the browser</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> system &nbsp;&nbsp;
<?php
if (function_exists('system')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>
                                                <br /><br /><pre class="breadcrumb">Passes commands output directly to the browser and returns last line</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> shell_exec &nbsp;&nbsp;
<?php
if (function_exists('shell_exec')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>
                                                <br /><br /><pre class="breadcrumb">Returns commands output</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> popen &nbsp;&nbsp; 
<?php
if (function_exists('popen')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>
                                                <br /><br /><pre class="breadcrumb">Opens read or write pipe to process of a command</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> proc_open &nbsp;&nbsp; 
<?php
if (function_exists('proc_open')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>
                                                <br /><br /><pre class="breadcrumb">Similar to popen() but greater degree of control</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> pcntl_exec &nbsp;&nbsp; 
<?php
if (function_exists('pcntl_exec')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>
                                                <br /><br /><pre class="breadcrumb">Executes a program</pre></h5>
									    	</div>
									</div>
									
									<div id="f2" class="tab-pane fade">
										<div class="card card-body bg-light">Apart from eval there are other ways to execute PHP code: include/require can be used for remote code execution in the form of Local File Include and Remote File Include vulnerabilities.</div><br />
										    <div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> eval &nbsp;&nbsp; 
                                                <span class="badge badge-danger">Not Disabled</span>
                                                <br /><br /><pre class="breadcrumb">Evaluate a string as PHP code</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> assert &nbsp;&nbsp; 
<?php
if (function_exists('assert')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>
                                                 <br /><br /><pre class="breadcrumb">Identical to eval()</pre></h5>
									    	</div>
                                            <div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> preg_replace &nbsp;&nbsp; 
<?php
if (function_exists('preg_replace')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>
                                                <br /><br /><pre class="breadcrumb">Does an eval() on match</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> create_function &nbsp;&nbsp; 
<?php
if (function_exists('create_function')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Create an anonymous (lambda-style) function</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> include &nbsp;&nbsp; 
                                                <span class="badge badge-danger">Not Disabled</span>
                                                <br /><br /><pre class="breadcrumb">Includes and evaluates the specified file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> include_once &nbsp;&nbsp; 
                                                <span class="badge badge-danger">Not Disabled</span>
                                                <br /><br /><pre class="breadcrumb">Includes and evaluates the specified file during the execution of script</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> require &nbsp;&nbsp; 
                                                <span class="badge badge-danger">Not Disabled</span>
                                                <br /><br /><pre class="breadcrumb">Identical to include</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> require_once &nbsp;&nbsp; 
                                                <span class="badge badge-danger">Not Disabled</span>
                                                <br /><br /><pre class="breadcrumb">Identical to require except PHP will check if the file has already been included, and if so, not include (require) it again.</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> allow_url_fopen &nbsp;&nbsp; 
<?php
if (function_exists('allow_url_fopen')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>
                                                <br /><br /><pre class="breadcrumb">This option enables the URL-aware fopen wrappers that enable accessing URL object like files - File inclusion vulnerability</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> allow_url_include &nbsp;&nbsp; 
<?php
if (function_exists('allow_url_include')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">This option allows the use of URL-aware fopen wrappers with the following functions: include, include_once, require, require_once - File inclusion vulnerability</pre></h5>
									    	</div>
									</div>
									
									<div id="f3" class="tab-pane fade">
									    <div class="card card-body bg-light">Most of these function calls are not sinks. But rather it maybe a vulnerability if any of the data returned is viewable to an attacker. If an attacker can see phpinfo() it is definitely a vulnerability.</div><br />
										    <div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> phpinfo &nbsp;&nbsp; 
<?php
if (function_exists('phpinfo')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                              
                                                <br /><br /><pre class="breadcrumb">Outputs information about PHP's configuration</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> expose_php &nbsp;&nbsp; 
<?php
if (function_exists('expose_php')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                  
                                                <br /><br /><pre class="breadcrumb">Adds your PHP version to the response headers and this could be used for security exploits</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> display_errors &nbsp;&nbsp; 
<?php
if (function_exists('display_errors')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Shows PHP errors to the client and this could be used for security exploits</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> display_startup_errors &nbsp;&nbsp; 
<?php
if (function_exists('display_startup_errors')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Shows PHP startup sequence errors to the client and this could be used for security exploits</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> posix_getlogin &nbsp;&nbsp; 
<?php
if (function_exists('posix_getlogin')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Return login name</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> posix_ttyname &nbsp;&nbsp; 
<?php
if (function_exists('posix_ttyname')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Determine terminal device name</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> getenv &nbsp;&nbsp; 
<?php
if (function_exists('getenv')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets the value of an environment variable</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> get_current_user &nbsp;&nbsp; 
<?php
if (function_exists('get_current_user')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets the name of the owner of the current PHP script</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> proc_get_status &nbsp;&nbsp; 
<?php
if (function_exists('proc_get_status')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Get information about a process opened by proc_open()</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> get_cfg_var &nbsp;&nbsp; 
<?php
if (function_exists('get_cfg_var')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets the value of a PHP configuration option</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> disk_free_space &nbsp;&nbsp; 
<?php
if (function_exists('disk_free_space')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Returns available space on filesystem or disk partition</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> disk_total_space &nbsp;&nbsp; 
<?php
if (function_exists('disk_total_space')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Returns the total size of a filesystem or disk partition</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> diskfreespace &nbsp;&nbsp; 
<?php
if (function_exists('diskfreespace')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Alias of disk_free_space()</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> getcwd &nbsp;&nbsp; 
<?php
if (function_exists('getcwd')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets the current working directory</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> getmygid &nbsp;&nbsp; 
<?php
if (function_exists('getmygid')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Get PHP script owner's GID</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> getmyinode &nbsp;&nbsp; 
<?php
if (function_exists('getmyinode')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets the inode of the current script</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> getmypid &nbsp;&nbsp; 
<?php
if (function_exists('getmypid')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets PHP's process ID</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> getmyuid &nbsp;&nbsp; 
<?php
if (function_exists('getmyuid')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets PHP script owner's UID</pre></h5>
									    	</div>
									</div>
									
									<div id="f4" class="tab-pane fade">
									    <div class="card card-body bg-light">According to RATS all filesystem functions in PHP are nasty. Some of these don't seem very useful to the attacker. Others are more useful than you might think. For instance if allow_url_fopen=On then a url can be used as a file path, so a call to copy($_GET['s'], $_GET['d']); can be used to upload a PHP script anywhere on the system. Also if a website is vulnerable to a request send via GET everyone of those file system functions can be abused to channel and attack to another host through your server.</div><br />
										    <div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> fopen &nbsp;&nbsp; 
<?php
if (function_exists('fopen')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Opens file or URL</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> tmpfile &nbsp;&nbsp; 
<?php
if (function_exists('tmpfile')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Creates a temporary file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> bzopen &nbsp;&nbsp; 
<?php
if (function_exists('bzopen')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Opens a bzip2 compressed file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> gzopen &nbsp;&nbsp; 
<?php
if (function_exists('gzopen')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Open gz-file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> SplFileObject->__construct &nbsp;&nbsp; 
                                                <span class="badge badge-danger">Not Disabled</span>
                                                <br /><br /><pre class="breadcrumb">Write to filesystem (partially in combination with reading)</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> chgrp &nbsp;&nbsp; 
<?php
if (function_exists('chgrp')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Changes file group</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> chmod &nbsp;&nbsp; 
<?php
if (function_exists('chmod')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Changes file mode</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> chown &nbsp;&nbsp; 
<?php
if (function_exists('chown')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Changes file owner</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> copy &nbsp;&nbsp; 
<?php
if (function_exists('copy')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Copies file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> file_put_contents &nbsp;&nbsp; 
<?php
if (function_exists('file_put_contents')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb"></pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> lchgrp &nbsp;&nbsp; 
<?php
if (function_exists('lchgrp')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Changes group ownership of symlink</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> lchown &nbsp;&nbsp; 
<?php
if (function_exists('lchown')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Changes user ownership of symlink</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> link &nbsp;&nbsp; 
<?php
if (function_exists('link')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Create a hard link</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> mkdir &nbsp;&nbsp; 
<?php
if (function_exists('mkdir')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Makes directory</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> move_uploaded_file &nbsp;&nbsp; 
<?php
if (function_exists('move_uploaded_file')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Moves an uploaded file to a new location</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> rename &nbsp;&nbsp; 
<?php
if (function_exists('rename')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Renames a file or directory</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> rmdir &nbsp;&nbsp; 
<?php
if (function_exists('rmdir')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Removes directory</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> symlink &nbsp;&nbsp; 
<?php
if (function_exists('symlink')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Creates a symbolic link</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> tempnam &nbsp;&nbsp; 
<?php
if (function_exists('tempnam')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Create file with unique file name</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> touch &nbsp;&nbsp; 
<?php
if (function_exists('touch')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Sets access and modification time of file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> unlink &nbsp;&nbsp; 
<?php
if (function_exists('unlink')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Deletes a file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> ftp_get &nbsp;&nbsp; 
<?php
if (function_exists('ftp_get')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Downloads a file from the FTP server</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> ftp_nb_get &nbsp;&nbsp; 
<?php
if (function_exists('ftp_nb_get')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Read from filesystem</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> file_exists &nbsp;&nbsp; 
<?php
if (function_exists('file_exists')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Checks whether a file or directory exists</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> file_get_contents &nbsp;&nbsp; 
<?php
if (function_exists('file_get_contents')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Reads entire file into a string</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> file &nbsp;&nbsp; 
<?php
if (function_exists('file')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Reads entire file into an array</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> fileatime &nbsp;&nbsp; 
<?php
if (function_exists('fileatime')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets last access time of file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> filectime &nbsp;&nbsp; 
<?php
if (function_exists('filectime')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets inode change time of file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> filegroup &nbsp;&nbsp; 
<?php
if (function_exists('filegroup')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets file group</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> fileinode &nbsp;&nbsp; 
<?php
if (function_exists('fileinode')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets file inode</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> filemtime &nbsp;&nbsp; 
<?php
if (function_exists('filemtime')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets file modification time</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> fileowner &nbsp;&nbsp; 
<?php
if (function_exists('fileowner')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets file owner</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> fileperms &nbsp;&nbsp; 
<?php
if (function_exists('fileperms')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets file permissions</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> filesize &nbsp;&nbsp; 
<?php
if (function_exists('filesize')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets file size</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> filetype &nbsp;&nbsp; 
<?php
if (function_exists('filetype')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets file type</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> glob &nbsp;&nbsp; 
<?php
if (function_exists('glob')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Find pathnames matching a pattern</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> is_dir &nbsp;&nbsp; 
<?php
if (function_exists('is_dir')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Tells whether filename is a directory</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> is_executable &nbsp;&nbsp; 
<?php
if (function_exists('is_executable')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Tells whether filename is executable</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> is_file &nbsp;&nbsp; 
<?php
if (function_exists('is_file')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Tells whether filename is a regular file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> is_link &nbsp;&nbsp; 
<?php
if (function_exists('is_link')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Tells whether filename is a symbolic link</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> is_readable &nbsp;&nbsp; 
<?php
if (function_exists('is_readable')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Tells whether a file exists and is readable</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> is_uploaded_file &nbsp;&nbsp; 
<?php
if (function_exists('is_uploaded_file')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Tells whether file was uploaded via HTTP POST</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> is_writable &nbsp;&nbsp; 
<?php
if (function_exists('is_writable')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Tells whether filename is writable</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> linkinfo &nbsp;&nbsp; 
<?php
if (function_exists('linkinfo')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gets information about a link</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> lstat &nbsp;&nbsp; 
<?php
if (function_exists('lstat')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gives information about a file or symbolic link</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> parse_ini_file &nbsp;&nbsp; 
<?php
if (function_exists('parse_ini_file')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Parse a configuration file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> pathinfo &nbsp;&nbsp; 
<?php
if (function_exists('pathinfo')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Returns information about a file path</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> readfile &nbsp;&nbsp; 
<?php
if (function_exists('readfile')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Outputs a file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> readlink &nbsp;&nbsp; 
<?php
if (function_exists('readlink')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Returns target of a symbolic link</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> realpath &nbsp;&nbsp; 
<?php
if (function_exists('realpath')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Returns canonicalized absolute pathname</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> stat &nbsp;&nbsp; 
<?php
if (function_exists('stat')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Gives information about a file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> gzfile &nbsp;&nbsp; 
<?php
if (function_exists('gzfile')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Read entire gz-file into an array</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> readgzfile &nbsp;&nbsp; 
<?php
if (function_exists('readgzfile')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Output a gz-file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> ftp_put &nbsp;&nbsp; 
<?php
if (function_exists('ftp_put')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Uploads a file to FTP server</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> ftp_nb_put &nbsp;&nbsp; 
<?php
if (function_exists('ftp_nb_put')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Stores a file on FTP server (non-blocking)</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> highlight_file &nbsp;&nbsp; 
<?php
if (function_exists('highlight_file')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Syntax highlighting of a file</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> show_source &nbsp;&nbsp; 
<?php
if (function_exists('show_source')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Alias of highlight_file()</pre></h5>
									    	</div>
									</div>
									
									<div id="f5" class="tab-pane fade">
									     <br />
										    <div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> extract &nbsp;&nbsp; 
<?php
if (function_exists('extract')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Opens the door for register_globals attacks</pre></h5>
									    	</div>
                                            <div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> parse_str &nbsp;&nbsp; 
<?php
if (function_exists('parse_str')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Works like extract if only one argument is given</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> putenv &nbsp;&nbsp; 
<?php
if (function_exists('putenv')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Sets value of an environment variable</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> ini_set &nbsp;&nbsp; 
<?php
if (function_exists('ini_set')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Sets value of a configuration option</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> mail &nbsp;&nbsp; 
<?php
if (function_exists('mail')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Has CRLF Injection in the 3rd parameter, opens the door for spam. </pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> header &nbsp;&nbsp; 
<?php
if (function_exists('header')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">On old systems CRLF injection could be used for xss or other purposes, now it is still a problem if they do a header("location: ..."); and they do not die();. The script keeps executing after a call to header(), and will still print output normally. This is nasty if you are trying to protect an administrative area. </pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> proc_nice &nbsp;&nbsp; 
<?php
if (function_exists('proc_nice')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Change the priority of current process</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> proc_terminate &nbsp;&nbsp; 
<?php
if (function_exists('proc_terminate')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Kills a process opened by proc_open</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> proc_close &nbsp;&nbsp; 
<?php
if (function_exists('proc_close')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Close a process opened by proc_open() and return the exit code of that process</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> pfsockopen &nbsp;&nbsp; 
<?php
if (function_exists('pfsockopen')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Open persistent Internet or Unix domain socket connection</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> fsockopen &nbsp;&nbsp; 
<?php
if (function_exists('fsockopen')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Open Internet or Unix domain socket connection</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> apache_child_terminate &nbsp;&nbsp; 
<?php
if (function_exists('apache_child_terminate')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Terminate apache process after request</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> posix_kill &nbsp;&nbsp; 
<?php
if (function_exists('posix_kill')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Send a signal to a process</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> posix_setpgid &nbsp;&nbsp; 
<?php
if (function_exists('posix_setpgid')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Set process group id for job control</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> posix_setsid &nbsp;&nbsp; 
<?php
if (function_exists('posix_setsid')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Make current process a session leader</pre></h5>
									    	</div>
											<div class="callout callout-default">
									    		<h5><i class="fas fa-code"></i> posix_setuid &nbsp;&nbsp; 
<?php
if (function_exists('posix_setuid')) {
    echo '<span class="badge badge-danger">Not Disabled</span>';
} else {
    echo '<span class="badge badge-success">Disabled</span>';
}
?>                                                
                                                <br /><br /><pre class="breadcrumb">Set UID of current process</pre></h5>
									    	</div>
									</div>
								</div>
							    </div>
                        </div>
                </div>
                    
				<div class="col-md-3">
				     <div class="card">
						<div class="card-header">
							<h3 class="card-title">Information & Tips</h3>
						</div>
				        <div class="card-body">
							  On this page you can see which vulnerable PHP Functions are enabled on your host.<br />
				              If you decide you can disable them from the php.ini file on your host.		
                        </div>
				     </div>
                     <div class="card">
						<div class="card-header">
							<h3 class="card-title">How to Disable PHP Functions</h3>
						</div>
				        <div class="card-body">
							  <ol>
									<li>Find the php.ini file on your host</li>
									<li>Open the php.ini file</li>
									<li>Find disable_functions and set new list as follows: <br /><br /><pre class="breadcrumb">disable_functions = exec,passthru,shell_exec,system,proc_open,popen,curl_multi_exec,parse_ini_file,show_source</pre></li>
									<li>Save and close the file. Restart the HTTPD Server (Apache)</li>
				             </ol>		
                        </div>
				     </div>
				</div>
				</div>
                    
				</div>
				</div>
				<!--===================================================-->
				<!--End page content-->

			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->
</div>
<?php
footer();
?>