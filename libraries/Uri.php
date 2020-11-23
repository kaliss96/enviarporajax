<?php 
define("_PERMITTED_URI_CHARS",'a-z 0-9~%.:_\-');
 
	function remove_invisible_characters($str, $url_encoded = TRUE)
	{
		$non_displayables = array();

		// every control character except newline (dec 10),
		// carriage return (dec 13) and horizontal tab (dec 09)
		if ($url_encoded)
		{
			$non_displayables[] = '/%0[0-8bcef]/';	// url encoded 00-08, 11, 12, 14, 15
			$non_displayables[] = '/%1[0-9a-f]/';	// url encoded 16-31
		}

		$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

		do
		{
			$str = preg_replace($non_displayables, '', $str, -1, $count);
		}
		while ($count);

		return $str;
	}

 function filter_uri(&$str)
	{
		if ( ! empty($str) && ! empty(_PERMITTED_URI_CHARS) && ! preg_match('/^['._PERMITTED_URI_CHARS.']+$/i'.(true ? 'u' : ''), $str))
		{
			show_error('The URI you submitted has disallowed characters.', 400);
		}
	}


	 function _set_uri_string($str)
	{
		// Filter out control characters and trim slashes
		$uri_string = trim(remove_invisible_characters($str, FALSE), '/');

		if ($uri_string !== '')
		{
			// Remove the URL suffix, if present
			if (($suffix = (string) "") !== '')
			{
				$slen = strlen($suffix);

				if (substr($uri_string, -$slen) === $suffix)
				{
					$uri_string = substr($uri_string, 0, -$slen);
				}
			}

			$segments[0] = NULL;
			// Populate the segments array
			foreach (explode('/', trim($uri_string, '/')) as $val)
			{
				$val = trim($val);
				// Filter segments for security
				filter_uri($val);

				if ($val !== '')
				{
					$segments[] = $val;
				}
			}

			unset($segments[0]);
		}
		return $segments;
	}
	
 function _remove_relative_directory($uri)
	{
		$uris = array();
		$tok = strtok($uri, '/');
		while ($tok !== FALSE)
		{
			if (( ! empty($tok) OR $tok === '0') && $tok !== '..')
			{
				$uris[] = $tok;
			}
			$tok = strtok('/');
		}

		return implode('/', $uris);
	}
 function _parse_request_uri()
	{
		if ( ! isset($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']))
		{
			return '';
		}

		$uri = parse_url($_SERVER['REQUEST_URI']);
		$query = isset($uri['query']) ? $uri['query'] : '';
		$uri = isset($uri['path']) ? $uri['path'] : '';

		if (isset($_SERVER['SCRIPT_NAME'][0]))
		{
			if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0)
			{
				$uri = (string) substr($uri, strlen($_SERVER['SCRIPT_NAME']));
			}
			elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0)
			{
				$uri = (string) substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
			}
		}

		// This section ensures that even on servers that require the URI to be in the query string (Nginx) a correct
		// URI is found, and also fixes the QUERY_STRING server var and $_GET array.
		if (trim($uri, '/') === '' && strncmp($query, '/', 1) === 0)
		{
			$query = explode('?', $query, 2);
			$uri = $query[0];
			$_SERVER['QUERY_STRING'] = isset($query[1]) ? $query[1] : '';
		}
		else
		{
			$_SERVER['QUERY_STRING'] = $query;
		}

		parse_str($_SERVER['QUERY_STRING'], $_GET);

		if ($uri === '/' OR $uri === '')
		{
			return '/';
		}

		// Do some final cleaning of the URI and return it
		return _remove_relative_directory($uri);
	}



