<?php return [

	/*
	 * Authorization code TTL in seconds
	 */
	'authorization_code_ttl' => 300,

	/*
	 * Access token TTL in seconds
	 */
	'access_token_ttl' => 3600,

	/*
	 * Refresh token ttl in seconds
	 */
	'refresh_token_ttl' => 604800,

	/*
	 * Default scopes to apply
	 */
	'default_scopes' => null,

	/*
	 * Require all tokens to have scopes
	 */
	'require_scopes' => false,

	/*
	 * Always require state param
	 */
	'require_state' => false,

	/*
	 * Rotate refresh tokens based on their TTL
	 */
	'rotate_refresh_tokens' => false,

	/*
	 * Token strategy, current options: bearer and mac
	 */
	'token_strategy' => 'bearer',

	/*
	 * Which grant types to enable
	 */
	'grant_types' => [

		'authorization_code',

		// 'client_credentials',
		// 'password',
		// 'refresh_token',

	],

];