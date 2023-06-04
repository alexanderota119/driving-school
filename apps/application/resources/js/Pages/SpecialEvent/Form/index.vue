<template>
    <div class="row">
        <div class="col-grow">
            <form-section>
                <ctx-input label="Event Name" name="name" required />
            </form-section>
            <form-section title="Time">
                <CtxDateTime label="Start Date" name="date_start" required />
                <CtxDateTime label="End Date" name="end_date" required />
            </form-section>
        </div>
    </div>
</template>
<script lang="ts" setup>
import FormSection from '@/Components/CtxForm/FormSection.vue';
import { CtxDateTime, CtxInput } from '@/Components/index';

// ad methods or variables here
</script>
