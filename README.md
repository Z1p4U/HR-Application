# HR Application

## API Reference

#### Login (Post)

```http
https://api.hr.yolodigitalmyanmar.com/api/v1/login
```

| Arguments | Type   | Description                  |
| :-------- | :----- | :--------------------------- |
| email     | sting  | **Required** admin@gmail.com |
| password  | string | **Required** asdffdsa        |

## User Profile

#### Create User (Post) - (Admin Only)

```http
https://api.hr.yolodigitalmyanmar.com/api/v1/register
```

| Arguments             | Type      | Description                              |
| :-------------------- | :-------- | :--------------------------------------- |
| name                  | string    | **Required** Post Malone                 |
| email                 | string    | **Required** admin@gmail.com             |
| phone                 | string    | **Required** 0977889911                  |
| role                  | enum      | **Required** [admin,probation,permanent] |
| position              | string    | **Required** Founder                     |
| jd                    | long text | **Required** Job Description             |
| annual_leave          | integer   | **Required** 0                           |
| casual_leave          | integer   | **Required** 2                           |
| probation_leave       | integer   | **Required** 3                           |
| unpaid_leave          | integer   | **Required** 10                          |
| password              | string    | **Required** asdffdsa                    |
| password_confirmation | string    | **Required** asdffdsa                    |
| agree                 | bool      | **Required** 1                           |

#### Own Profile (Get)

```http
https://api.hr.yolodigitalmyanmar.com/api/v1/your-profile
```

#### Check Specific User Profile (Get) - (Admin Only)

```http
https://api.hr.yolodigitalmyanmar.com/api/v1/user-profile/{id}
```

#### Check User Lists (Get) - (Admin Only)

```http
https://api.hr.yolodigitalmyanmar.com/api/v1/user-lists
```

#### Edit User Info(Get)

```http
https://api.hr.yolodigitalmyanmar.com/api/v1/edit
```

| Arguments | Type  | Description              |
| :-------- | :---- | :----------------------- |
| name      | sting | **Required** Post Malone |

#### Password Update (Put)

```http
https://api.hr.yolodigitalmyanmar.com/api/v1/update-password
```

| Arguments             | Type   | Description           |
| :-------------------- | :----- | :-------------------- |
| current_password      | sting  | **Required** asdffdsa |
| password              | string | **Required** asdffdsa |
| password_confirmation | string | **Required** asdffdsa |

#### Logout (Post)

```http
https://api.hr.yolodigitalmyanmar.com/api/v1/logout
```

#### Logout from all devices(Post) - (Admin Only)

```http
https://api.hr.yolodigitalmyanmar.com/api/v1/logout-all
```

## Attendance Management

### Attendance

#### Attendance List (Get)

```https
https://api.hr.yolodigitalmyanmar.com/api/v1/attendance/index
```

#### Check In (Post)

```https
https://api.hr.yolodigitalmyanmar.com/api/v1/check-in
```

#### Check Out (Post)

```https
https://api.hr.yolodigitalmyanmar.com/api/v1/check-out
```

Note : You can check in / out one time in each day

### Monthly Attendance

#### Monthly Attendance Record (Get) - (Admin Only)

```https
https://api.hr.yolodigitalmyanmar.com/api/v1/monthly/index
```

## Requesting Leave

#### Request Leave (Post)

```https
https://api.hr.yolodigitalmyanmar.com/api/v1/leave/request
```

| Arguments      | Type    | Description                               |
| :------------- | :------ | :---------------------------------------- |
| requested_days | integer | **Required** (1-10)                       |
| leave_type     | integer | **Required** Read Note below              |
| date           | array   | **Required** [ "2023-9-10", "2023-9-15" ] |
| reason         | string  | **Required** any reason                   |

Note : leave_type should be one of [annual_leave,casual_leave,probation_leave,unpaid_leave]

#### Approve Leave (Put) - (Admin Only)

```https
https://api.hr.yolodigitalmyanmar.com/api/v1/leave/approve/{id}
```

#### Denies Leave (Put) - (Admin Only)

```https
https://api.hr.yolodigitalmyanmar.com/api/v1/leave/denies/{id}
```

#### Leave Request List (Get)

```https
https://api.hr.yolodigitalmyanmar.com/api/v1/leave/request/list
```
