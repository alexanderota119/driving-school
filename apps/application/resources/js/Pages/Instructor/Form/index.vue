<template>
    <div class="row">
        <div class="col-grow">
            <form-section title="Personal Information">
                <ctx-input label="First Name" name="first_name" required />

                <ctx-input label="Last Name" name="last_name" required />
            </form-section>

            <form-section title="Contact information">
                <ctx-input label="Email" name="email" required />

                <ctx-phone label="Phone" name="phone" />

                <api-ctx-select
                    label="Car"
                    model="cars"
                    name="car_id"
                    required
                />

                <ctx-address :required="false" />

                <ctx-checkbox label="Is Inactive" name="is_inactive" />
            </form-section>
            <form-section title="Password Reset">
                <ctx-input
                    autocomplete="off"
                    label="Password"
                    name="password"
                    type="password"
                />

                <ctx-input
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
import CtxCheckbox from '@/Components/CtxCheckbox';
import FormSection from '@/Components/CtxForm/FormSection.vue';
</script>
