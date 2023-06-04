export interface UserDateTime {
    date: string;
    datetime: string;
    for_human: string;
    is_utc: boolean;
    time: string;
    timezone: {
        timezone: string;
        timezone_type: number;
    };
    type: string;
    utc_offset: number;
    valid: boolean;
    is_dirty?: boolean;
}
