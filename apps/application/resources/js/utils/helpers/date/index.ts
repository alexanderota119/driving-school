import { UserDateTime } from '@/utils/types/date';
import moment from 'moment';
import { Moment } from 'moment/moment';

export const convertToMoment = (str: string, obj: UserDateTime): Moment => {
    if (obj.is_utc) {
        return moment.utc(str).local();
    }

    return moment(str).utcOffset(obj.utc_offset).local();
};

export const userTime = (
    obj: UserDateTime,
    message = 'invalid format',
): Moment | string => {
    if (!obj.valid) {
        return message;
    }

    return convertToMoment(obj.datetime, obj).format('LY');
};

export const userDate = (
    obj: UserDateTime,
    message = 'invalid format',
): Moment | string => {
    if (!obj.valid) {
        return message;
    }
    return convertToMoment(obj.datetime, obj).format('L');
};

export const userDatetime = (
    obj: UserDateTime | string | undefined,
    message = 'invalid format',
): Moment | string => {
    if (!obj || typeof obj === 'string') {
        return message;
    }

    console.log('userDatetime', {
        obj,
        message,
    });

    if (!obj.valid) {
        return message;
    }

    return convertToMoment(obj.datetime, obj).format('L LT');
};

export const userHumanReadable = (
    obj: UserDateTime,
    message = 'invalid format',
): string | boolean => {
    if (!obj.valid) {
        return message;
    }

    return obj.for_human;
};
