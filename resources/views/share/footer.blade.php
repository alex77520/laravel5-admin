				<!--/span-->
			</div><!--/row-->
			<?php if(Auth::check() && Auth::user()->status != 1) echo View::make('share.lock');?>
			<!-- Le javascript -->
			<!-- Placed at the end of the document so the pages load faster -->
		</div><!--/.fluid-container-->
	</body>
</html>
