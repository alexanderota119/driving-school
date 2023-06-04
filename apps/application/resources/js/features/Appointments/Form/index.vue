<template>
    <div class="row">
        <div class="col-grow">
            <CtxInputInstructorWithCar required />
            <api-ctx-select
                label="Appointment Type"
                model="appointment_types"
                name="appointment_type_id"
                required
            />
            <api-ctx-select
                label="Test Location"
                model="test_locations"
                name="test_location_id"
                required
            />
            <ctx-checkbox
                label="Test Passed?"
                name="test_passed"
                type="checkbox"
            />
            <CtxDateTime label="date" name="date" required type="date" />
            <CtxDateTime
                label="Time Start"
                name="time_start"
                required
                type="time"
            />
            <CtxDateTime
                :min-time="fieldValueTimeStart"
                label="Time End"
                name="time_end"
                required
                type="time"
            />
            <ctx-input label="Dl304a" name="dl304a" />
            <ctx-input label="Dl304c" name="dl304c" />
        </div>
        <div class="col-grow">
            <ctx-address
                :required="false"
                label="Pickup Location"
                name="pickup_location"
            />
            <CtxNotes />
        </div>
    </div>
</template>
<script lang="ts" setup>
import {
    CtxDateTime,
    CtxInputInstructorWithCar,
    CtxNotes,
} from '@/Components/index';
import { formStateUpdate } from '@/utils';
import { EdDrivingComputedRef } from '@/utils/types/form';
import { inject } from 'vue';

const fieldValueTimeStart = (inject(formStateUpdate) as EdDrivingComputedRef)(
    'time_start',
) as string;
</script>
