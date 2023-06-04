<template>
    <div class="container mt-3">
        <ctx-form action="/register" add-submit-button method="post">
            <div class="row">
                <div class="col-grow">
                    <ctx-domain-input :default-domain="default_domain" />
                    <ctx-input label="First Name" name="first_name" required />
                    <ctx-input label="Middle Name" name="middle_name" />
                    <ctx-input label="Last Name" name="last_name" required />
                    <ctx-input label="Email" name="email" required />
                    <ctx-input
                        label="Phone Number"
                        name="phone_number"
                        type="tel"
                    />

                    <ctx-input
                        label="Password"
                        name="password"
                        required
                        type="password"
                    />
                    <ctx-input
                        label="Password Confirmation"
                        name="password_confirmation"
                        required
                        type="password"
                    />
                </div>
            </div>
        </ctx-form>
    </div>
</template>
<script lang="ts" setup>
import CtxDomainInput from './CtxDomainInput';

defineProps<{
    plan_name: string;
    default_domain: string;
}>();
//
</script>
