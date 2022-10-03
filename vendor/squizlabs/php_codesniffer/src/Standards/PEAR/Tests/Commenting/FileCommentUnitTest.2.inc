<?php

/**
 * Shows open transactions for admins
 */
#[Authenticate('admin_logged_in')]
class TodoController extends AbstractController implements MustBeLoggedInInterface
{
}
