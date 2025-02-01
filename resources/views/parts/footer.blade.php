		@if (Session::has('info-message'))
			<div class="info-message">{{ Session::get('info-message') }}</div>
		@endif
		@if (Session::has('error-message'))
			<div class="error-message">{{ Session::get('error-message') }}</div>
		@endif
	</main>
	<footer>
		
	</footer>
</body>
</html>