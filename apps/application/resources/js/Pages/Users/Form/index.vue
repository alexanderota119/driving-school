<template>
    <div class="row">
        <div class="col-grow">
            <form-section title="Personal Information">
                <ctx-input label="First Name" name="first_name" required />

                <ctx-input label="Last Name" name="last_name" required />
            </form-section>

            <form-section title="Contact Information">
                <ctx-input label="Email" name="email" required />

                <ctx-phone label="Phone" name="phone.number" />

                <ctx-address :required="false" />
            </form-section>

            <form-section title="Password Reset">
                <ctx-password
                    autocomplete="off"
                    label="Password"
                    name="password"
                    type="password"
                />

                <ctx-password
                    autocomplete="off"
                    label="Password Confirmation"
                    name="password_confirmation"
                    type="password"
                />
            </form-section>
        </div>
    </div>
</template>
<script lang="ts" setup>
import FormSection from '@/Components/CtxForm/FormSection.vue';

// add methods or variables here
</script>
