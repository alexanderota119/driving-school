<template>
    <div class="row">
        <div class="col-md-8">
            <form-section>
                <ctx-input label="Name" name="name" />
            </form-section>
            <form-section title="Course Details">
                <ctx-date-time label="Class Time" name="class_time" />
                <ctx-input
                    label="Duration in minutes (1.5 hours would be 90 minutes)"
                    mask="####"
                    max="500"
                    min="1"
                    name="duration"
                    step="1"
                    suffix="Minutes"
                    type="number"
                />
            </form-section>
        </div>
        <div class="col-md-4">
            <CtxNotes />
            <CtxRating />
        </div>
    </div>
</template>
<script lang="ts" setup>
import { CtxRating } from '@/Components';
import FormSection from '@/Components/CtxForm/FormSection.vue';
import { CtxDateTime, CtxInput, CtxNotes } from '@/Components/index';
//
</script>
