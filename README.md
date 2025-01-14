# project
project/
├── api/
│   ├── customers/
│   │   ├── add_customer.php
│   │   ├── get_customers.php
│   │   ├── update_customer.php
│   │   └── delete_customer.php
│   ├── orders/
│   │   ├── add_order.php
│   │   ├── get_orders.php
│   │   ├── update_order.php
│   │   └── delete_order.php
│   ├── after_sales/
│   │   ├── add_after_sale.php
│   │   ├── get_after_sales.php
│   │   ├── update_after_sale.php
│   │   └── delete_after_sale.php
│   ├── statistics/
│   │   ├── get_statistics.php
│   │   └── get_employee_statistics.php
│   └── employees/
│       ├── add_employee.php
│       ├── get_employees.php
│       ├── update_employee.php
│       ├── delete_employee.php
│       ├── login.php
│       └── logout.php
├── db/
│   └── db_connect.php
├── frontend/
│   ├── login.html
│   └── dashboard.html
└── docs/
    └── api_documentation.md







 以下是基于所有代码实现的完整API文档，详细描述了每个接口的功能、请求参数、响应格式和使用方法。

---

## 论文订单管理系统 API 文档

### 基础信息

- **Base URL**: `http://localhost/project/api/`
- **数据格式**: JSON
- **认证方式**: Session（登录后使用）

---

### 1. 员工管理

#### 1.1 添加员工

- **URL**: `employees/add_employee.php`
- **方法**: `POST`
- **请求参数**:

  | 参数名         | 类型   | 必填 | 说明           |
  |----------------|--------|------|----------------|
  | `department_id`| int    | 是   | 部门ID         |
  | `role_id`      | int    | 是   | 角色ID         |
  | `username`     | string | 是   | 用户名         |
  | `full_name`    | string | 否   | 姓名           |
  | `email`        | string | 是   | 邮箱           |
  | `password`     | string | 是   | 密码           |
  | `status`       | string | 是   | 状态（如active）|

- **请求示例**:

  ```json
  {
    "department_id": 1,
    "role_id": 1,
    "username": "admin2",
    "email": "admin2@example.com",
    "password": "password",
    "status": "active"
  }
  ```

- **响应示例**:

  ```json
  {
    "success": true,
    "message": "员工添加成功"
  }
  ```

---

#### 1.2 获取员工列表

- **URL**: `employees/get_employees.php`
- **方法**: `GET`
- **请求参数**: 无
- **响应示例**:

  ```json
  {
    "success": true,
    "data": [
      {
        "employee_id": 1,
        "department_id": 1,
        "role_id": 1,
        "username": "admin",
        "full_name": "管理员",
        "email": "admin@example.com",
        "status": "active"
      }
    ]
  }
  ```

---

#### 1.3 更新员工信息

- **URL**: `employees/update_employee.php`
- **方法**: `POST`
- **请求参数**:

  | 参数名         | 类型   | 必填 | 说明           |
  |----------------|--------|------|----------------|
  | `employee_id`  | int    | 是   | 员工ID         |
  | `department_id`| int    | 否   | 部门ID         |
  | `role_id`      | int    | 否   | 角色ID         |
  | `username`     | string | 否   | 用户名         |
  | `full_name`    | string | 否   | 姓名           |
  | `email`        | string | 否   | 邮箱           |
  | `status`       | string | 否   | 状态           |

- **请求示例**:

  ```json
  {
    "employee_id": 1,
    "full_name": "新管理员"
  }
  ```

- **响应示例**:

  ```json
  {
    "success": true,
    "message": "员工信息更新成功"
  }
  ```

---

#### 1.4 删除员工

- **URL**: `employees/delete_employee.php`
- **方法**: `POST`
- **请求参数**:

  | 参数名        | 类型 | 必填 | 说明   |
  |---------------|------|------|--------|
  | `employee_id` | int  | 是   | 员工ID |

- **请求示例**:

  ```json
  {
    "employee_id": 1
  }
  ```

- **响应示例**:

  ```json
  {
    "success": true,
    "message": "员工删除成功"
  }
  ```

---

### 2. 客户管理

#### 2.1 添加客户

- **URL**: `customers/add_customer.php`
- **方法**: `POST`
- **请求参数**:

  | 参数名          | 类型   | 必填 | 说明           |
  |-----------------|--------|------|----------------|
  | `customer_name` | string | 是   | 客户名称       |
  | `customer_type` | string | 是   | 客户分类       |
  | `contact_info`  | string | 否   | 联系方式       |
  | `added_by`      | int    | 是   | 添加人ID       |
  | `operator`      | int    | 是   | 操作员ID       |

- **请求示例**:

  ```json
  {
    "customer_name": "客户A",
    "customer_type": "VIP",
    "added_by": 1,
    "operator": 1
  }
  ```

- **响应示例**:

  ```json
  {
    "success": true,
    "message": "客户添加成功"
  }
  ```

---

#### 2.2 获取客户列表

- **URL**: `customers/get_customers.php`
- **方法**: `GET`
- **请求参数**: 无
- **响应示例**:

  ```json
  {
    "success": true,
    "data": [
      {
        "customer_id": 1,
        "customer_name": "客户A",
        "customer_type": "VIP",
        "contact_info": "123456789",
        "added_by": 1,
        "operator": 1
      }
    ]
  }
  ```

---

#### 2.3 更新客户信息

- **URL**: `customers/update_customer.php`
- **方法**: `POST`
- **请求参数**:

  | 参数名          | 类型   | 必填 | 说明           |
  |-----------------|--------|------|----------------|
  | `customer_id`   | int    | 是   | 客户ID         |
  | `customer_name` | string | 否   | 客户名称       |
  | `customer_type` | string | 否   | 客户分类       |
  | `contact_info`  | string | 否   | 联系方式       |
  | `added_by`      | int    | 否   | 添加人ID       |
  | `operator`      | int    | 否   | 操作员ID       |

- **请求示例**:

  ```json
  {
    "customer_id": 1,
    "customer_name": "新客户名称"
  }
  ```

- **响应示例**:

  ```json
  {
    "success": true,
    "message": "客户信息更新成功"
  }
  ```

---

#### 2.4 删除客户

- **URL**: `customers/delete_customer.php`
- **方法**: `POST`
- **请求参数**:

  | 参数名        | 类型 | 必填 | 说明   |
  |---------------|------|------|--------|
  | `customer_id` | int  | 是   | 客户ID |

- **请求示例**:

  ```json
  {
    "customer_id": 1
  }
  ```

- **响应示例**:

  ```json
  {
    "success": true,
    "message": "客户删除成功"
  }
  ```

---

### 3. 订单管理

#### 3.1 添加订单

- **URL**: `orders/add_order.php`
- **方法**: `POST`
- **请求参数**:

  | 参数名              | 类型     | 必填 | 说明           |
  |---------------------|----------|------|----------------|
  | `order_number`      | string   | 是   | 订单编号       |
  | `customer_id`       | int      | 是   | 客户ID         |
  | `received_date`     | date     | 是   | 接稿日期       |
  | `delivery_date`     | date     | 是   | 交稿日期       |
  | `total_amount`      | decimal  | 是   | 总金额         |
  | `actual_payment`    | decimal  | 是   | 实际收款       |
  | `sales_department`  | string   | 是   | 销售部门       |
  | `major`             | string   | 是   | 专业           |
  | `title`             | string   | 是   | 题目           |
  | `word_count`        | int      | 是   | 字数           |
  | `requirements`      | string   | 是   | 文章要求       |
  | `transaction_status`| string   | 是   | 交易状态       |
  | `order_status`      | string   | 是   | 订单状态       |
  | `writer_status`     | string   | 是   | 写手状态       |
  | `sales_status`      | string   | 是   | 销售状态       |
  | `payment_shop`      | string   | 是   | 收款店铺       |
  | `notes`             | string   | 否   | 备注           |
  | `writer_id`         | string   | 是   | 写手ID列表     |

- **请求示例**:

  ```json
  {
    "order_number": "ORD123",
    "customer_id": 1,
    "received_date": "2023-10-01",
    "delivery_date": "2023-10-10",
    "total_amount": 1000.00,
    "actual_payment": 800.00,
    "sales_department": "销售部A",
    "major": "计算机科学",
    "title": "论文标题",
    "word_count": 5000,
    "requirements": "无特殊要求",
    "transaction_status": "已支付",
    "order_status": "进行中",
    "writer_status": "未发货",
    "sales_status": "已确认",
    "payment_shop": "店铺A",
    "notes": "无",
    "writer_id": "1,2"
  }
  ```

- **响应示例**:

  ```json
  {
    "success": true,
    "message": "订单添加成功"
  }
  ```

---

#### 3.2 获取订单列表

- **URL**: `orders/get_orders.php`
- **方法**: `GET`
- **请求参数**: 无
- **响应示例**:

  ```json
  {
    "success": true,
    "data": [
      {
        "order_id": 1,
        "order_number": "ORD123",
        "customer_id": 1,
        "received_date": "2023-10-01",
        "delivery_date": "2023-10-10",
        "total_amount": 1000.00,
        "actual_payment": 800.00,
        "sales_department": "销售部A",
        "major": "计算机科学",
        "title": "论文标题",
        "word_count": 5000,
        "requirements": "无特殊要求",
        "transaction_status": "已支付",
        "order_status": "进行中",
        "writer_status": "未发货",
        "sales_status": "已确认",
        "payment_shop": "店铺A",
        "notes": "无",
        "writer_id": "1,2"
      }
    ]
  }
  ```

---

#### 3.3 更新订单信息

- **URL**: `orders/update_order.php`
- **方法**: `POST`
- **请求参数**:

  | 参数名              | 类型     | 必填 | 说明           |
  |---------------------|----------|------|----------------|
  | `order_id`          | int      | 是   | 订单ID         |
  | `order_number`      | string   | 否   | 订单编号       |
  | `customer_id`       | int      | 否   | 客户ID         |
  | `received_date`     | date     | 否   | 接稿日期       |
  | `delivery_date`     | date     | 否   | 交稿日期       |
  | `total_amount`      | decimal  | 否   | 总金额         |
  | `actual_payment`    | decimal  | 否   | 实际收款       |
  | `sales_department`  | string   | 否   | 销售部门       |
  | `major`             | string   | 否   | 专业           |
  | `title`             | string   | 否   | 题目           |
  | `word_count`        | int      | 否   | 字数           |
  | `requirements`      | string   | 否   | 文章要求       |
  | `transaction_status`| string   | 否   | 交易状态       |
  | `order_status`      | string   | 否   | 订单状态       |
  | `writer_status`     | string   | 否   | 写手状态       |
  | `sales_status`      | string   | 否   | 销售状态       |
  | `payment_shop`      | string   | 否   | 收款店铺       |
  | `notes`             | string   | 否   | 备注           |
  | `writer_id`         | string   | 否   | 写手ID列表     |

- **请求示例**:

  ```json
  {
    "order_id": 1,
    "order_status": "已完成"
  }
  ```

- **响应示例**:

  ```json
  {
    "success": true,
    "message": "订单信息更新成功"
  }
  ```

---

#### 3.4 删除订单

- **URL**: `orders/delete_order.php`
- **方法**: `POST`
- **请求参数**:

  | 参数名        | 类型 | 必填 | 说明   |
  |---------------|------|------|--------|
  | `order_id`    | int  | 是   | 订单ID |

- **请求示例**:

  ```json
  {
    "order_id": 1
  }
  ```

- **响应示例**:

  ```json
  {
    "success": true,
    "message": "订单删除成功"
  }
  ```

---

### 4. 售后管理

#### 4.1 添加售后记录

- **URL**: `after_sales/add_after_sale.php`
- **方法**: `POST`
- **请求参数**:

  | 参数名              | 类型     | 必填 | 说明           |
  |---------------------|----------|------|----------------|
  | `order_id`          | int      | 是   | 订单ID         |
  | `feedback_issue`    | string   | 是   | 反馈问题       |
  | `issue_description` | string   | 是   | 问题描述       |
  | `feedback_date`     | date     | 是   | 反馈日期       |
  | `processing_date`   | date     | 是   | 处理日期       |
  | `is_processed`      | boolean  | 是   | 是否处理       |
  | `writer_id`         | string   | 是   | 写手ID列表     |

- **请求示例**:

  ```json
  {
    "order_id": 1,
    "feedback_issue": "质量问题",
    "issue_description": "文章质量不达标",
    "feedback_date": "2023-10-05",
    "processing_date": "2023-10-06",
    "is_processed": false,
    "writer_id": "1,2"
  }
  ```

- **响应示例**:

  ```json
  {
    "success": true,
    "message": "售后记录添加成功"
  }
  ```

---

#### 4.2 获取售后记录列表

- **URL**: `after_sales/get_after_sales.php`
- **方法**: `GET`
- **请求参数**: 无
- **响应示例**:

  ```json
  {
    "success": true,
    "data": [
      {
        "after_sale_id": 1,
        "order_id": 1,
        "feedback_issue": "质量问题",
        "issue_description": "文章质量不达标",
        "feedback_date": "2023-10-05",
        "processing_date": "2023-10-06",
        "is_processed": false,
        "writer_id": "1,2"
      }
    ]
  }
  ```

---

#### 4.3 更新售后记录

- **URL**: `after_sales/update_after_sale.php`
- **方法**: `POST`
- **请求参数**:

  | 参数名              | 类型     | 必填 | 说明           |
  |---------------------|----------|------|----------------|
  | `after_sale_id`     | int      | 是   | 售后记录ID     |
  | `order_id`          | int      | 否   | 订单ID         |
  | `feedback_issue`    | string   | 否   | 反馈问题       |
  | `issue_description` | string   | 否   | 问题描述       |
  | `feedback_date`     | date     | 否   | 反馈日期       |
  | `processing_date`   | date     | 否   | 处理日期       |
  | `is_processed`      | boolean  | 否   | 是否处理       |
  | `writer_id`         | string   | 否   | 写手ID列表     |

- **请求示例**:

  ```json
  {
    "after_sale_id": 1,
    "is_processed": true
  }
  ```

- **响应示例**:

  ```json
  {
    "success": true,
    "message": "售后记录更新成功"
  }
  ```

---

#### 4.4 删除售后记录

- **URL**: `after_sales/delete_after_sale.php`
- **方法**: `POST`
- **请求参数**:

  | 参数名            | 类型 | 必填 | 说明       |
  |-------------------|------|------|------------|
  | `after_sale_id`   | int  | 是   | 售后记录ID |

- **请求示例**:

  ```json
  {
    "after_sale_id": 1
  }
  ```

- **响应示例**:

  ```json
  {
    "success": true,
    "message": "售后记录删除成功"
  }
  ```

---

### 5. 数据统计

#### 5.1 获取统计数据

- **URL**: `statistics/get_statistics.php`
- **方法**: `GET`
- **请求参数**: 无
- **响应示例**:

  ```json
  {
    "success": true,
    "data": {
      "customer_count": 10,
      "order_count": 50,
      "after_sale_count": 5,
      "amount_total": 50000.00,
      "word_count_total": 250000
    }
  }
  ```

---

### 6. 登录与登出

#### 6.1 登录

- **URL**: `employees/login.php`
- **方法**: `POST`
- **请求参数**:

  | 参数名     | 类型   | 必填 | 说明   |
  |------------|--------|------|--------|
  | `username` | string | 是   | 用户名 |
  | `password` | string | 是   | 密码   |

- **请求示例**:

  ```json
  {
    "username": "admin",
    "password": "password"
  }
  ```

- **响应示例**:

  ```json
  {
    "success": true,
    "message": "登录成功"
  }
  ```

---

#### 6.2 登出

- **URL**: `employees/logout.php`
- **方法**: `POST`
- **请求参数**: 无
- **响应示例**:

  ```json
  {
    "success": true,
    "message": "登出成功"
  }
  ```

---

### 总结

以上是完整的API文档，涵盖了员工管理、客户管理、订单管理、售后管理和数据统计等功能。每个接口都详细描述了请求参数、响应格式和使用方法。如果有其他需求，请随时告诉我！
