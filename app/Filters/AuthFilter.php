<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // The session holds a staff ID only after a successful password check.
        if (! session()->get('staff_id')) {
            // Remember a protected GET page so sign in can return the visitor there.
            if ($request->getMethod() === 'GET') {
                $path = '/' . ltrim($request->getUri()->getPath(), '/');
                session()->set('auth_redirect', $path);
                session()->set('auth_notice', str_starts_with($path, '/customers')
                    ? 'Sign in to view customer accounts.'
                    : 'Sign in to view staff accounts.');
            }
            return redirect()->to(site_url('login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
