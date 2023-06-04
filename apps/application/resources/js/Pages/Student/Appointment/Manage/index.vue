<template>
    <page-title title="Manage Student Appointments" />

    <ed-button
        :href="`/students/${student.id}/appointments/create`"
        text="Create"
    />

    <ul>
        <li>
            <app-link :href="`/students/${student.id}/edit`">
                <strong>Student Name:</strong> {{ student.name }}
            </app-link>
        </li>
        <li><strong>Student Email:</strong> {{ student.email }}</li>
        <li>
            <strong>Student Type:</strong>
            {{ student?.student_type?.label || 'n/a' }}
        </li>
    </ul>

    <Calendar
        :events="data.events"
        :loading="data.loading"
        @event-click="handleSetEvent"
        @dates-selected="handleDateSelected"
    />

    <Modal
        v-if="
            data?.event?.id &&
            data?.appointments &&
            data.appointments[data.event.id]
        "
        :form="extendedProps"
        :show="!!data.event"
        class="calendar-event-view modal-lg"
        size="xl"
        @cancel="handleSetEvent()"
        @hide="handleSetEvent()"
        @ok="handleEventOk"
    >
        <CtxForm
            :action="`/students/${student.id}/appointments/${data.event.id}`"
            :form="data.appointments[data.event.id]"
            method="put"
        >
            <AppointmentForm :event="data.appointments[data.event.id]" />
        </CtxForm>
    </Modal>

    <ed-button text="Show Test Modal" @click="showTestModal = true" />
    <Modal v-model="showTestModal" title="Create Appointment">
        <ctx-form :form="testModalMessage" @submit="handleCreateAppointment">
            <div class="col-grow">
                <AppointmentForm :event="testModalMessage" />
            </div>

            <ed-button text="Submit" type="submit" />
        </ctx-form>
    </Modal>
</template>
<script lang="ts" setup>
import { Calendar, Modal } from '@/Components';
import AppointmentForm from '@/features/Appointments/Form';

import { CalendarEventType, DateSelectionType } from '@/utils/types/calendar';
import useApiCalls, { PUT } from '@/utils/useApiCalls';
import { computed, reactive, ref } from 'vue';

const data = reactive<{
    loading: boolean;
    events: CalendarEventType[];
    event?: CalendarEventType;
    appointments?: App.Models.Appointment[];
}>({
    loading: false,
    events: [],
    event: undefined,
});

const { student } = defineProps<{
    student: App.Models.Student;
}>();

const showTestModal = ref(false);

(async () => {
    data.loading = true;
    const response = await useApiCalls(
        `/api/students/${student.id}/appointments`,
    );
    data.events = response?.data ?? ([] as CalendarEventType[]);
    data.appointments = response?.appointments ?? ([] as CalendarEventType[]);
    data.loading = false;
})();

const handleSetEvent = (event: CalendarEventType | undefined = undefined) => {
    data.event = event;
};

const extendedProps = computed(() => {
    return data?.event?.extendedProps || {};
});

const handleEventOk = async (formData: any) => {
    try {
        await useApiCalls(
            `/api/students/${student.id}/appointments/${data?.event?.id}`,
            {
                method: PUT,
                params: formData,
            },
        );

        data.event = undefined;
    } catch (e) {
        alert('Error saving the form');
    }
};

const testModalMessage = ref<Partial<App.Models.Appointment>>();

const handleDateSelected = (selection: DateSelectionType) => {
    const appointment: Partial<App.Models.Appointment> = {
        date: selection?.start?.format('Y-m-d'),
        time_start: selection?.start as unknown as number,
        time_end: selection?.end as unknown as number,
        appointment_type_id: undefined,
        test_location_id: undefined,
        test_passed: undefined,
        car_id: undefined,
        pickup_location_id: undefined,
        dl304a: null,
        dl304c: null,
    };

    console.log('handleDateSelected', {
        selection,
        appointment,
    });

    testModalMessage.value = appointment;
    showTestModal.value = true;

    // alert(testModalMessage);
};

const handleCreateAppointment = (formData: App.Models.Appointment) => {
    console.log('handleCreateAppointment', { formData });
};
</script>
