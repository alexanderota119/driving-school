<template>
    <div class="row">
        <div class="col-md-8">
            <ctx-input label="Car Name" name="name" />
            <ctx-input label="license Plate" name="license_plate" />
            <ctx-input label="Make" name="make" />
            <ctx-input label="Model" name="model" />
            <ctx-input
                :max="maxYear"
                label="Year"
                min="1900"
                name="year"
                step="1"
                type="number"
            />
            <api-ctx-select
                v-if="false"
                label="Assigned to Instructor"
                model="instructors"
                name="instructor_id"
            />
        </div>
        <div class="col-grow">
            <ctx-color label="Color" name="color" />
            <CtxRating />
        </div>
    </div>
</template>
<script lang="ts" setup>
import { ApiCtxSelect, CtxInput, CtxRating } from '@/Components/index';
import moment from 'moment';
import { computed } from 'vue';
// ad methods or variables here

const maxYear = computed(() => {
    return moment().add(2, 'year').format('YYYY');
});
</script>
