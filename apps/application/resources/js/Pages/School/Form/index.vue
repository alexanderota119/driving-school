<template>
    <div class="row">
        <div class="col-grow">
            <form-section>
                <ctx-input label="School Name" name="name" />
            </form-section>
            <form-section title="Contact Information">
                <ctx-address :required="false" />
            </form-section>
        </div>
    </div>
</template>
<script lang="ts" setup>
import FormSection from '@/Components/CtxForm/FormSection.vue';
//
</script>
