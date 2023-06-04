// https://fullcalendar.io/docs/event-object
import { ViewApi } from '@fullcalendar/vue3';
import { MomentInput } from 'moment';
import { Moment } from 'moment/moment';

export interface CalendarEventType extends Partial<App.Models.Appointment> {
    title: string;
    start: string;
    end: string;
    allDay?: boolean;
    textColor?: string; // https://fullcalendar.io/docs/eventTextColor

    [key: string]: any;
}

export interface DateSelectionType {
    allDay: boolean;
    start: Moment;
    end: MomentInput;
    startStr: string;
    endStr: string;
    jsEvent: MouseEvent;
    view: ViewApi;

    dayCount: number;
}
