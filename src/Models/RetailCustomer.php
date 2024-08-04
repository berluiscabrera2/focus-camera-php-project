<?php

namespace FocusCamera\Models;

class RetailCustomer extends Customer {
    public function getType(): string {
        return 'Retail';
    }
}