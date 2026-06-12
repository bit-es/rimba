# Action classes

| Grouping | Verb | When to Use It (Comment) | Example Action Class |
| :--- | :--- | :--- | :--- |
| **Creating** | **Create** | When adding a brand new record to your database. | `CreateUser`, `CreateInvoice` |
| | **Register** | Specifically for onboarding new users, guests, or tenants. | `RegisterNewCompany`, `RegisterGuest` |
| | **Store** | When saving raw files or specific data chunks. | `StoreProductDetails`, `StoreUploadedFile` |
| | **Generate** | When making something new from existing data (like PDFs). | `GenerateMonthlyReport`, `GenerateInvoicePdf` |
| | **Publish** | When making draft content visible to the public. | `PublishBlogPost`, `PublishProductListing` |
| **Updating** | **Update** | When changing data that already exists in the system. | `UpdateUserProfile`, `UpdateCartQuantity` |
| | **Change** | When swapping one specific state or value for another. | `ChangeUserPassword`, `ChangeSubscriptionPlan` |
| | **Reset** | When clearing a value back to its original blank or default state. | `ResetPassword`, `ResetLoginAttempts` |
| | **Sync** | When matching database relationships to a specific list. | `SyncUserRoles`, `SyncProductInventory` |
| | **Toggle** | When switching a feature between on and off. | `ToggleFeatureFlag`, `ToggleUserStatus` |
| **Removing** | **Delete** | When permanently wiping a record from the database. | `DeleteAccount`, `DeleteComment` |
| | **Remove** | When taking an item out of a collection, group, or cart. | `RemoveItemFromCart`, `RemoveUserFromTeam` |
| | **Archive** | When hiding old data without fully deleting it from the system. | `ArchiveOldLogs`, `ArchiveInactiveUsers` |
| | **Cancel** | When stopping a continuous process or an upcoming event. | `CancelSubscription`, `CancelOrder` |
| | **Disable** | When turning off a user feature or locking an account safely. | `DisableTwoFactorAuth`, `DisableUser` |
| **Processing** | **Process** | For heavy business rules or multi-step payment tasks. | `ProcessOrderPayment`, `ProcessRefund` |
| | **Calculate** | When running math formulas to get a total amount. | `CalculateOrderTotal`, `CalculateTax` |
| | **Send** | When pushing out communications like emails, texts, or alerts. | `SendWelcomeEmail`, `SendSlackNotification` |
| | **Verify** | When checking if a piece of token or user input is valid. | `VerifyEmailAddress`, `VerifyCouponCode` |
| | **Import** / **Export** | When moving large chunks of data in or out of the app via files. | `ImportUsersFromCsv`, `ExportFinancialData` |
| | **Apply** | When putting a rule or a fee onto a specific total. | `ApplyDiscountCode`, `ApplyLateFee` |
| **Security** | **Login** / **Logout** | For handling user session entry and exit safely. | `LoginUser`, `LogoutAllDevices` |

# Services classes
| Grouping | Service Name | When to Use It (Comment) | Common Methods Inside |
| :--- | :--- | :--- | :--- |
| **Third-Party APIs** | `StripeService` | For talking to outside APIs or tools. | `charge()`, `refund()`, `createCustomer()` |
| | `TwilioService` | For sending SMS or managing phone systems. | `sendSms()`, `verifyNumber()` |
| | `AwsS3Service` | For managing cloud file assets. | `upload()`, `delete()`, `generatePresignedUrl()` |
| **Complex Business** | `PayrollService` | For heavy internal domain logic with math. | `calculateSalary()`, `disburseFunds()` |
| | `TaxService` | For calculating complicated rates and fees. | `getRateForZip()`, `calculateTotalTax()` |
| | `InventoryService` | For tracking stock movements across warehouses. | `reserveStock()`, `restockItem()` |
| **System Utilities** | `MarkdownService` | For converting text formats or parsing data. | `toHtml()`, `stripTags()` |
| | `GeocodingService` | For translating addresses to map coordinates. |
