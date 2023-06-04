<template>
    <ctx-form id="contactForm">
        <ctx-input label="First Name" name="first_name" />
        <ctx-input label="Last Name" name="last_name" />
        <ctx-input label="Email" name="email" type="email" />

        <ctx-textarea label="Message" name="message" type="textarea" />

        <div class="d-grid">
            <ed-button
                id="submitButton"
                class="btn btn-primary btn-lg disabled"
                type="submit"
            >
                Submit
            </ed-button>
        </div>
    </ctx-form>
</template>
<script lang="ts" setup>
defineProps<{}>();
//
</script>
