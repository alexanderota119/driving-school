<template>
    <div :md="6" class="col-grow">
        <api-ctx-select
            :name="name"
            :required="required"
            label="Instructor"
            model="instructors"
            @change="handleInstructorChanged"
        />
    </div>
    <div :md="6" class="col-grow">
        <api-ctx-select
            :name="name_car"
            :required="required"
            label="Car"
            model="cars"
        />
    </div>
</template>
<script lang="ts" setup>
import { formStateUpdate, getError } from '@/utils';
import { EdDrivingComputedRef } from '@/utils/types/form';
import { ModelIdType } from '@/utils/types/models';
import { inject } from 'vue';

interface Props {
    name?: string;
    name_car?: string;
    required?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    name: 'instructor_id',
    name_car: 'car_id',
    required: false,
});

type HandleInstructorChangedType = (
    selectedInstructorId: number,
    instructor: any,
) => void;

const instructorCar =
    inject<EdDrivingComputedRef<ModelIdType>>(formStateUpdate)('car_id');

const error = inject<EdDrivingComputedRef<string[]>>(getError)(props.name);

const handleInstructorChanged: HandleInstructorChangedType = (
    _,
    { option: { car_id = null } = {} },
) => {
    instructorCar.value = car_id;
};
</script>
