export interface Domain {
    domain: string;
    tenant_id: string;
}

export interface TenantModel extends App.Models.Tenant {
    logo: {
        path: string;
        alt: string;
    };

    name: string;
    domains: Domain[];
}

export interface InstructorModel extends App.Models.Instructor {
    name: string;
    auth?: boolean;
}

export interface StudentModel extends App.Models.Student {
    name: string;
    auth?: boolean;
}

export interface UserModel extends App.Models.User {
    name: string;
    auth?: boolean;
}
