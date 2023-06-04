<template>
    <div class="row">
        <div class="col-grow">
            <form-section>
                <ctx-input label="Date Off" name="date_time_off" />

                <ctx-input label="Start" name="time_start" />

                <ctx-input label="End" name="time_end" />

                <ctx-input label="Instructor" name="instructor.name" />
            </form-section>
        </div>
    </div>
</template>
<script lang="ts" setup>
import FormSection from '@/Components/CtxForm/FormSection.vue';

// ad methods or variables here
</script>
