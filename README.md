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
| annual_leave          | float     | **Required** 10                          |
| casual_leave          | float     | **Required** 2                           |
| probation_leave       | float     | **Required** 3                           |
| unpaid_leave          | float     | **Required** 10                          |
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
Note : If Your check in time is late than 09:15 It will automatically add late count.

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

| Arguments      | Type      | Description                               |
| :------------- | :-------- | :---------------------------------------- |
| half_day       | boolean   | **Required** true or false                |
| requested_days | float     | **Sometimes** Read Note 1 below           |
| leave_type     | string    | **Required** Read Note 2 below            |
| date           | array     | **Required** [ "2023-9-10", "2023-9-15" ] |
| reason         | long text | **Required** any reason                   |

Note 1 : If half_day is true requested_days will automatically (0.5)s. If not requested_days will be inputted amount.

Note 2 : leave_type should be one of [annual_leave,casual_leave,probation_leave,unpaid_leave].

#### Approve Leave (Put) - (Admin Only)

```https
https://api.hr.yolodigitalmyanmar.com/api/v1/leave/approve/{id}
```

#### Denies Leave (Put) - (Admin Only)

```https
https://api.hr.yolodigitalmyanmar.com/api/v1/leave/denies/{id}
```

#### Leave Request List (Get) - (Admin Only)

```https
https://api.hr.yolodigitalmyanmar.com/api/v1/leave/request/list
```

#### Leave Request Detail (Get) - (Admin Only)

```https
https://api.hr.yolodigitalmyanmar.com/api/v1/leave/request/detail/{id}
```

#### Your Request Record (Get)

```https
https://api.hr.yolodigitalmyanmar.com/api/v1/leave/request/your-list
```
