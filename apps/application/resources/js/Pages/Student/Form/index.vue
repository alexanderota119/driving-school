<template>
    <div class="row">
        <div class="col-md-8">
            <form-section title="Personal information">
                <div class="row">
                    <div class="col-grow">
                        <ctx-input
                            label="First Name"
                            name="first_name"
                            required
                        />
                    </div>
                    <div class="col-grow">
                        <ctx-input
                            label="Last Name"
                            name="last_name"
                            required
                        />
                    </div>
                    <div class="col-grow">
                        <ctx-input label="Middle Name" name="middle_name" />
                    </div>
                </div>
            </form-section>

            <form-section title="Contact information and preferences">
                <ctx-input label="Email" name="email" required />
                <ctx-phone label="Phone" name="phone" />
            </form-section>

            <form-section title="Student information">
                <api-ctx-select
                    label="Student Type"
                    model="student_types"
                    name="student_type_id"
                    required
                />
                <api-ctx-select
                    label="School"
                    model="schools"
                    name="school_id"
                />
            </form-section>

            <form-section title="Address">
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
        <div class="col-grow">
            <CtxNotes />
            <CtxRating label="Rating" />
        </div>
    </div>
</template>
<script lang="ts" setup>
import FormSection from '@/Components/CtxForm/FormSection.vue';
import { CtxNotes, CtxRating } from '@/Components/index';

//
</script>
