<template>
    <div class="row">
        <div class="col-grow">
            <form-section>
                <ctx-input label="Name" name="name" required />
            </form-section>

            <form-section title="Test Details">
                <ctx-input
                    label="Duration"
                    max="1000"
                    min="0"
                    name="duration"
                    required
                    step="15"
                    suffix="Minute(s)"
                    type="number"
                />

                <ctx-input
                    help="During the appointment, how long should the test take?"
                    label="Test Offset"
                    max="1000"
                    min="0"
                    name="test_offset"
                    step="15"
                    suffix="Minute(s)"
                    type="number"
                />

                <ctx-checkbox
                    label="Is this a Test"
                    name="is_test"
                    type="checkbox"
                />
            </form-section>
        </div>
    </div>
</template>
<script lang="ts" setup>
import FormSection from '@/Components/CtxForm/FormSection.vue';

// ad methods or variables here
defineProps<{
    hideName: boolean;
}>();
</script>
