<template>
    <FullCalendar :options="calendarOptions" />
</template>
<script lang="ts" setup>
import { CalendarEventType, DateSelectionType } from '@/utils/types/calendar';
import { EventClickArg } from '@fullcalendar/common';
import { CalendarOptions } from '@fullcalendar/core';
/**
 * @docs https://fullcalendar.io/docs
 */
import '@fullcalendar/core/vdom'; // solves problem with Vite
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import timeGridPlugin from '@fullcalendar/timegrid';
import FullCalendar from '@fullcalendar/vue3';
import moment from 'moment';
import { computed, reactive } from 'vue';

interface Props {
    events: CalendarEventType[];
    loading?: boolean;
    initialView?: ('dayGridMonth' | 'timeGridWeek') & string;
}

interface Data {}

const props = withDefaults(defineProps<Props>(), {
    initialView: 'timeGridWeek',
});

const data = reactive<Data>({});

const emit = defineEmits([
    'event-delete',
    'event-change',
    'event-create',
    'event-click',
    'dates-selected',
]);

const onEventClick = (event: EventClickArg): void => {
    emit('event-click', event.event);
};

const onEventDrop = (event: EventClickArg): void => {
    emit('event-change', event);
};

const onDatesSelected = (selection: DateSelectionType): void => {
    selection.start = moment(selection.start);
    selection.end = moment(selection.end);

    // diff in days starts at 0
    selection.dayCount = selection.end.diff(selection.start, 'days') || 0;

    emit('dates-selected', selection);
};

const calendarOptions = computed<CalendarOptions>(() => {
    return {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'timeGridDay,dayGridMonth,timeGridWeek',
        },
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        initialView: props.initialView as unknown as StringConstructor,
        nowIndicator: true,
        editable: true,
        weekNumbers: true,
        weekTextLong: 'long',
        selectable: true,
        eventOverlap: true,

        eventClick: onEventClick,
        eventDrop: onEventDrop,
        eventResize: onEventDrop,

        select: onDatesSelected,

        events: props.events,

        // selectConstraint: {
        //     start: '00:01',
        //     end: '23:59',
        // },

        // loading: !!props.loading, // not how this is used
        // eventClick: function ({event}) {
        //     alert('Event: ' + event.title);
        //     // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
        //     // alert('View: ' + info.view.type);
        //
        //     // change the border color just for fun
        //     // info.el.style.borderColor = 'red';
        // },
    } as unknown as CalendarOptions;
});
</script>
