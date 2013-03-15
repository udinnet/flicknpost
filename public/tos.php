<?php require_once("../includes/initialize.php"); ?>
<?php echo public_template("Terms of Service"); ?>
       <div id="fnp_menu">
    
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="flickblog.php">FlickBlog</a></li>
                <?php if($session->is_logged_in())
                { ?>
                    <li><a href="admin/index.php">Control Panel</a></li>
                    <li><a href="admin/logout.php">Logout</a></li>
                <?php }
                else { ?>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="admin/login.php">Login</a></li>
                <?php } ?>
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>    	
    
    	</div> <!-- end of fnp_menu -->
        
        <div class="cleaner"></div>
	</div> <!-- end of header -->
    
    <div id="fnp_content">
        <center><h1>Terms of Service</h1></center>
        <p style="margin-top: 10px;"></p>

<h3>
	1. Terms
</h3>

<p>
	By accessing this web site, you are agreeing to be bound by these 
	web site Terms and Conditions of Use, all applicable laws and regulations, 
	and agree that you are responsible for compliance with any applicable local 
	laws. If you do not agree with any of these terms, you are prohibited from 
	using or accessing this site. The materials contained in this web site are 
	protected by applicable copyright and trade mark law.
</p>

<h3>
	2. Use License
</h3>

<ol type="a">
	<li>
		Permission is granted to temporarily download one copy of the materials 
		(information or software) on Flick & Post's web site for personal, 
		non-commercial transitory viewing only. This is the grant of a license, 
		not a transfer of title, and under this license you may not:
		
		<ol type="i">
			<li>modify or copy the materials;</li>
			<li>use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</li>
			<li>attempt to decompile or reverse engineer any software contained on Flick & Post's web site;</li>
			<li>remove any copyright or other proprietary notations from the materials; or</li>
			<li>transfer the materials to another person or "mirror" the materials on any other server.</li>
		</ol>
	</li>
	<li>
		This license shall automatically terminate if you violate any of these restrictions and may be terminated by Flick & Post at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.
	</li>
</ol>

<h3>
	3. Disclaimer
</h3>

<ol type="a">
	<li>
		The materials on Flick & Post's web site are provided "as is". Flick & Post makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Further, Flick & Post does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its Internet web site or otherwise relating to such materials or on any sites linked to this site.
	</li>
</ol>

<h3>
	4. Limitations
</h3>

<p>
	In no event shall Flick & Post or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption,) arising out of the use or inability to use the materials on Flick & Post's Internet site, even if Flick & Post or a Flick & Post authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.
</p>
			
<h3>
	5. Revisions and Errata
</h3>

<p>
	The materials appearing on Flick & Post's web site could include technical, typographical, or photographic errors. Flick & Post does not warrant that any of the materials on its web site are accurate, complete, or current. Flick & Post may make changes to the materials contained on its web site at any time without notice. Flick & Post does not, however, make any commitment to update the materials.
</p>

<h3>
	6. Links
</h3>

<p>
	Flick & Post has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Flick & Post of the site. Use of any such linked web site is at the user's own risk.
</p>

<h3>
	7. Site Terms of Use Modifications
</h3>

<p>
	Flick & Post may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use.
</p>

<h3>
	8. Governing Law
</h3>

<p>
	Any claim relating to Flick & Post's web site shall be governed by the laws of the State of Sri Lanka without regard to its conflict of law provisions.
</p>

<p>
	General Terms and Conditions applicable to Use of a Web Site.
</p>
			
<?php
include_footer_layout('footer.php');
?>