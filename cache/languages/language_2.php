<?php
if(!isset($GLOBALS['all_words']))
{
	$GLOBALS['all_words'] = array (
  '[[.home_page.]]' => 'Home page',
  '[[.contact_us.]]' => 'Contact us',
  '[[.support_online.]]' => 'Support online',
  '[[.view_all.]]' => 'View all',
  '[[.tags.]]' => 'Tags',
  '[[.visitors.]]' => 'Visitors',
  '[[.online.]]' => 'Online',
  '[[.weather.]]' => 'Weather',
  '[[.humidity.]]' => 'Humidity',
  '[[.source.]]' => 'Source',
  '[[.exchange_rate.]]' => 'Exchange rate',
  '[[.gold_rate.]]' => 'Gold rate',
  '[[.vang_sjc_1l.]]' => 'sjc 1l',
  '[[.buy.]]' => 'Buy',
  '[[.sell.]]' => 'Sell',
  '[[.select_other_survey.]]' => 'Select other survey',
  '[[.surveyed_readers.]]' => 'Surveyed readers',
  '[[.send_comment.]]' => 'Send comment',
  '[[.result.]]' => 'Result',
  '[[.admin_survey.]]' => 'Admin survey',
  '[[.weblink.]]' => 'Weblink',
  '[[.choose_link.]]' => 'Choose link',
  '[[.product_promotion.]]' => 'Product promotion',
  '[[.in_basket.]]' => 'in basket',
  '[[.add_basket.]]' => 'Add basket',
  '[[.news_latest.]]' => 'News latest',
  '[[.view_more.]]' => 'View more',
  '[[.news.]]' => 'News',
  '[[.next_page.]]' => 'Next page',
  '[[.product.]]' => 'Product',
  '[[.have.]]' => 'have',
  '[[.product_in_basket.]]' => 'Product in basket',
  '[[.delete.]]' => 'Delete',
  '[[.view_basket.]]' => 'View basket',
  '[[.compare.]]' => 'Compare',
  '[[.gallery.]]' => 'Gallery',
  '[[.required_field.]]' => 'Required field',
  '[[.full_name.]]' => 'Full name',
  '[[.phone.]]' => 'Phone',
  '[[.email.]]' => 'Email',
  '[[.confirm_code.]]' => 'Confirm code',
  '[[.Content.]]' => 'Content',
  '[[.send_contact.]]' => 'Send contact',
  '[[.reset.]]' => 'Reset',
  '[[.hitcount.]]' => 'Hitcount',
  '[[.last_updated.]]' => 'Last updated',
  '[[.share.]]' => 'Share',
  '[[.facebook.]]' => 'Facebook',
  '[[.twitter.]]' => 'Twitter',
  '[[.google.]]' => 'Google',
  '[[.print.]]' => 'Print',
  '[[.back.]]' => 'Back',
  '[[.page_up.]]' => 'Up',
  '[[.old_news.]]' => 'Older',
  '[[.basket.]]' => 'Basket',
  '[[.product_name.]]' => 'Product name',
  '[[.quantity.]]' => 'Quantity',
  '[[.unit_price.]]' => 'Unit price',
  '[[.total.]]' => 'Total',
  '[[.contact_us_information.]]' => 'Contact information',
  '[[.advanced_search.]]' => 'Advanced search',
  '[[.yes.]]' => 'yes',
  '[[.no.]]' => 'No',
  '[[.sell_price.]]' => 'Sell price',
  '[[.inclusive_of_vat.]]' => 'Inclusive of vat',
  '[[.warranty.]]' => 'Warranty',
  '[[.promotion.]]' => 'Promotion',
  '[[.status.]]' => 'Status',
  '[[.available.]]' => 'Available',
  '[[.review.]]' => 'Review',
  '[[.description.]]' => 'Description',
  '[[.specification.]]' => 'Specification',
  '[[.share_your_opinions_with_others.]]' => 'Share your opinions with others',
  '[[.required.]]' => 'Required',
  '[[.send.]]' => 'Send',
  '[[.product_other.]]' => 'Product other',
  '[[.welcome.]]' => 'Welcome',
  '[[.sign_out.]]' => 'Sign_out',
  '[[.change_password.]]' => 'Change password',
  '[[.home.]]' => 'Home',
  '[[.nick.]]' => 'Nick',
  '[[.name.]]' => 'Name',
  '[[.type.]]' => 'Type',
  '[[.add.]]' => 'Add',
  '[[.add_successfull.]]' => 'Add successfull',
  '[[.edit_nick_support_online.]]' => 'Edit nick support online',
  '[[.save.]]' => 'Save',
  '[[.close.]]' => 'Close',
  '[[.action.]]' => 'Action',
  '[[.edit.]]' => 'Edit',
  '[[.nick_is_not_empty.]]' => 'Nick is not empty',
  '[[.name_is_not_empty.]]' => 'Name is not empty',
  '[[.nick_is_exists.]]' => 'Nick is exists',
  '[[.are_you_sure_delete_this_item.]]' => 'Are you sure delete this item?',
  '[[.check_all.]]' => 'Check all',
  '[[.sort.]]' => 'Sort',
  '[[.image_url.]]' => 'Image url',
  '[[.category.]]' => 'Category',
  '[[.poster.]]' => 'Poster',
  '[[.post_date.]]' => 'Post date',
  '[[.id.]]' => 'ID',
  '[[.comment.]]' => 'Comment',
  '[[.select.]]' => 'Select',
  '[[.select_all.]]' => 'Select all',
  '[[.select_none.]]' => 'Select none',
  '[[.select_invert.]]' => 'Select invert',
  '[[.top.]]' => 'Top',
  '[[.brief.]]' => 'Brief',
  '[[.options.]]' => 'Option',
  '[[.url_key.]]' => 'Url key',
  '[[.position.]]' => 'Position',
  '[[.meta.]]' => 'Meta',
  '[[.title.]]' => 'Title',
  '[[.keyword.]]' => 'Keyword',
  '[[.images_related.]]' => 'Images related',
  '[[.name_id.]]' => 'Name id',
  '[[.menutop.]]' => 'Menu top',
  '[[.menubottom.]]' => 'Menu bottom',
  '[[.up.]]' => 'Up',
  '[[.down.]]' => 'Down',
  '[[.parent_name.]]' => 'Parent name',
  '[[.out_url.]]' => 'Out url',
  '[[.menu_top.]]' => 'Menu top',
  '[[.menu_bottom.]]' => 'Menu bottom',
  '[[.menu_left.]]' => 'Menu left',
  '[[.sitemap.]]' => 'Sitemap',
  '[[.nofollow.]]' => 'Nofollow',
  '[[.add_item.]]' => 'Add item',
  '[[.view.]]' => 'View',
  '[[.show.]]' => 'Show',
  '[[.hide.]]' => 'Hide',
  '[[.publish.]]' => 'Publish',
  '[[.content.]]' => 'Content',
  '[[.rate.]]' => 'Rate',
  '[[.price.]]' => 'Price',
  '[[.last_modified.]]' => 'Last modified',
  '[[.general.]]' => 'General',
  '[[.code.]]' => 'Code',
  '[[.transport.]]' => 'Transport',
  '[[.images.]]' => 'Images',
  '[[.base_image.]]' => 'Base image',
  '[[.small_image.]]' => 'Small image',
  '[[.thumbnail.]]' => 'Thumbnail',
  '[[.prices.]]' => 'Price',
  '[[.special_price.]]' => 'Special price',
  '[[.special_price_from_date.]]' => 'Special price from date',
  '[[.special_price_to_date.]]' => 'Special price to date',
  '[[.vat.]]' => 'VAT',
  '[[.promotion_from_date.]]' => 'Promotion from date',
  '[[.promotion_to_date.]]' => 'Promotion to date',
  '[[.attribute.]]' => 'Attribute',
  '[[.label.]]' => 'Label',
  '[[.meta_infomation.]]' => 'Meta infomation',
  '[[.meta_title.]]' => 'Meta title',
  '[[.meta_keyword.]]' => 'Meta keyword',
  '[[.meta_description.]]' => 'Meta description',
  '[[.input_type.]]' => 'Input type',
  '[[.searchable.]]' => 'Searchable',
  '[[.search_type.]]' => 'Search type',
  '[[.compareable.]]' => 'Compareable',
  '[[.hide_in_list.]]' => 'Hide in list',
  '[[.attribute_value.]]' => 'Attribute_value',
  '[[.address.]]' => 'Address',
  '[[.account.]]' => 'Account',
  '[[.total_amount.]]' => 'Total amount',
  '[[.order_date.]]' => 'Order date',
  '[[.detail.]]' => 'Detail',
  '[[.small_thumb_url.]]' => 'Small thumb url',
  '[[.media.]]' => 'Media',
  '[[.youtube_link.]]' => 'Youtube link',
  '[[.url.]]' => 'Url',
  '[[.media_related.]]' => 'Media related',
  '[[.youtube_link_related.]]' => 'Youtube link related',
  '[[.file.]]' => 'File',
  '[[.region.]]' => 'Region',
  '[[.start_time.]]' => 'Start time',
  '[[.end_time.]]' => 'End time',
  '[[.click.]]' => 'Click',
  '[[.list_advertisment.]]' => 'List advertisment',
  '[[.question.]]' => 'Question',
  '[[.multi_is_select.]]' => 'Multi is select',
  '[[.count.]]' => 'Count',
  '[[.edit_weblink.]]' => 'Edit weblink',
  '[[.title_is_not_empty.]]' => 'Title is not empty',
  '[[.url_is_not_empty.]]' => 'Url is not empty',
  '[[.size.]]' => 'Size',
  '[[.edit_tag.]]' => 'Edit tag',
  '[[.tag_name.]]' => 'Tag name',
  '[[.name_is_exists.]]' => 'Name is exists',
  '[[.active.]]' => 'Active',
  '[[.block.]]' => 'Block',
  '[[.create_date.]]' => 'Create date',
  '[[.last_online.]]' => 'Last online',
  '[[.grant_privilege.]]' => 'Grant privilege',
  '[[.user_name.]]' => 'User name',
  '[[.password.]]' => 'Password',
  '[[.account_id.]]' => 'Account',
  '[[.Grant.]]' => 'Grant',
  '[[.privilege.]]' => 'Privilege',
  '[[.privilege_id.]]' => 'Privilege id',
  '[[.function.]]' => 'Function',
  '[[.Add.]]' => 'Add',
  '[[.Edit.]]' => 'Edit',
  '[[.Delete.]]' => 'Delete',
  '[[.Moderator.]]' => 'Moderator',
  '[[.reserve.]]' => 'Reserve',
  '[[.admin.]]' => 'Admin',
  '[[.default_language.]]' => 'Default language',
  '[[.default_currency.]]' => 'Default currency',
  '[[.icon_on_address.]]' => 'Icon on address',
  '[[.logo.]]' => 'Logo',
  '[[.background.]]' => 'Background',
  '[[.background_color.]]' => 'Background color',
  '[[.website_title.]]' => 'Website title',
  '[[.website_keywords.]]' => 'Website keywords',
  '[[.website_description.]]' => 'Website description',
  '[[.google_analytics.]]' => 'Google analytics',
  '[[.google_key.]]' => 'Google key',
  '[[.map_coordinates.]]' => 'Map coordinates',
  '[[.marker_content.]]' => 'Marker content',
  '[[.default.]]' => 'Default',
  '[[.icon_url.]]' => 'Icon url',
  '[[.all.]]' => 'All',
  '[[.transfer.]]' => 'Transfer',
  '[[.are_you_want_to_delete.]]' => 'Are you want to delete?',
  '[[.field_name.]]' => 'Field name',
  '[[.value.]]' => 'Value',
  '[[.package.]]' => 'Package',
  '[[.page_structure.]]' => 'Page structure',
  '[[.duplicate.]]' => 'Duplicate',
  '[[.setting.]]' => 'Setting',
  '[[.function_extend.]]' => 'Function extend',
  '[[.table_name.]]' => 'Table name',
  '[[.Engine.]]' => 'Engine',
  '[[.Version.]]' => 'Version',
  '[[.Row_format.]]' => 'Row format',
  '[[.Rows.]]' => 'Rows',
  '[[.Avg_row_length.]]' => 'Avg row length',
  '[[.Data_length.]]' => 'Data length',
  '[[.Max_data_length.]]' => 'Max data length',
  '[[.Index_length.]]' => 'Index length',
  '[[.Auto_increment.]]' => 'Auto increment',
  '[[.Create_time.]]' => 'Create time',
  '[[.Update_time.]]' => 'Update time',
  '[[.Total.]]' => 'Total',
  '[[.table.]]' => 'Table',
  '[[.file_size.]]' => 'File size',
  '[[.system_info.]]' => 'System info',
  '[[.PHP_configs.]]' => 'PHP configs',
  '[[.apache2handler.]]' => 'Apache2handler',
  '[[.Apache_environment.]]' => 'Apache environment',
  '[[.Graph_driver.]]' => 'Graph driver',
  '[[.mysql.]]' => 'Mysql',
  '[[.session.]]' => 'Session',
  '[[.System_info.]]' => 'System information',
  '[[.prev_page.]]' => 'Prev page',
  '[[.old_password.]]' => 'Old password',
  '[[.attribute_name.]]' => 'Attribute_name',
  '[[.new_password.]]' => 'New password',
  '[[.retype_new_password.]]' => 'Retype new password',
  '[[.map.]]' => 'Map',
  '[[.rss.]]' => 'Rss',
  '[[.channels_RSS_Feeds.]]' => 'Channels RSS Feeds',
  '[[.data_not_found.]]' => 'Data not found',
  '[[.id_dont_exist.]]' => 'Data don\'t exists',
  '[[.account_register.]]' => 'Account register',
  '[[.symbol.]]' => 'Symbol',
  '[[.retype_password.]]' => 'Retype password',
  '[[.birthday.]]' => 'Birthday',
  '[[.gender.]]' => 'Gender',
  '[[.register.]]' => 'Register',
  '[[.module_setting.]]' => 'Module setting',
  '[[.have_not_product_in_shopcart.]]' => 'have not product in shopcart',
  '[[.get_password.]]' => 'Get password',
  '[[.please_enter_email_register_we_will_send_new_password_to_email_for_you.]]' => 'Please_enter email register we will_send_new_password to email for you',
  '[[.based_on.]]' => 'based on',
  '[[.reviews.]]' => 'Reviews',
  '[[.stars.]]' => 'Stars',
  '[[.write_a_review.]]' => 'Write a review',
  '[[.reviewed_by.]]' => 'Reviewed by',
  '[[.customers.]]' => 'Customers',
  '[[.data_is_updating.]]' => 'Data is updating',
  '[[.newer_news.]]' => 'Newer',
  '[[.order.]]' => 'Order',
  '[[.copyright.]]' => 'Copyright',
  '[[.please_enter_name.]]' => 'Please enter name',
  '[[.please_choose_category.]]' => 'Please choose category',
  '[[.notify_errors.]]' => 'Notify errors',
  '[[.login.]]' => 'Login',
  '[[.lost_password.]]' => 'Lost password',
  '[[.upload.]]' => 'Upload',
  '[[.rename.]]' => 'Rename',
  '[[.this_function_is_locking.]]' => 'This function is locking',
  '[[.general_config.]]' => 'General config',
  '[[.help.]]' => 'Help',
  '[[.please_enter_attribute_name.]]' => 'Please enter attribute name',
  '[[.please_choose_display.]]' => 'Please choose display',
  '[[.select_survey.]]' => 'Select survey',
  '[[.please_enter_position.]]' => 'Please enter position',
  '[[.best_selling_products.]]' => 'Best selling products',
  '[[.uncheck.]]' => 'Uncheck',
  '[[.general_information.]]' => 'General information',
  '[[.option.]]' => 'Option',
  '[[.meta_information.]]' => 'Meta information',
  '[[.media_url.]]' => 'Media url',
  '[[.in_stock.]]' => 'in stock',
  '[[.availability.]]' => 'Availability',
  '[[.non_inclusive_of_vat.]]' => 'Non inclusive of vat',
  '[[.not_in_stock.]]' => 'Not in stock',
  '[[.module_name.]]' => 'Module name',
  '[[.group_name.]]' => 'Group name',
  '[[.module_id.]]' => 'Module id',
  '[[.default_value.]]' => 'Default value',
  '[[.value_list.]]' => 'Value list',
  '[[.edit_condition.]]' => 'Edit condition',
  '[[.view_condition.]]' => 'View condition',
  '[[.extend.]]' => 'Extend',
  '[[.group_column.]]' => 'Group column',
  '[[.update_code.]]' => 'Update code',
  '[[.confirm_password.]]' => 'Confirm password',
  '[[.new_customers.]]' => 'New customers',
  '[[.login_or_create_new_customer.]]' => 'login or create new customer',
  '[[.invalid_user_id.]]' => 'Invalid account',
  '[[.invalid_password.]]' => 'Invalid password',
  '[[.login_or_create_an_account.]]' => 'login or create an account',
  '[[.create_an_account.]]' => 'Create an account',
  '[[.login_to_admin_panel.]]' => 'login to admin panel',
  '[[.forgot_password.]]' => 'Forgot password',
  '[[.customer_group.]]' => 'Customer group',
  '[[.page.]]' => 'Page',
  '[[.group_price.]]' => 'Group price',
  '[[.tier_price.]]' => 'Tier price',
  '[[.mark.]]' => 'Mark',
  '[[.with.]]' => 'with',
  '[[.group_price_with_customer.]]' => 'Group price with customer',
  '[[.and.]]' => 'and',
  '[[.regular_price.]]' => 'Regular price',
  '[[.with_price.]]' => 'With price',
  '[[.Quantity.]]' => 'Quantity',
  '[[.total_number.]]' => 'Total number',
  '[[.voting_paper.]]' => 'Voting paper',
  '[[.total_voting.]]' => 'Total voting',
  '[[.no_result.]]' => 'No result',
  '[[.account_id_not_exist.]]' => 'Account id not exist',
  '[[.confirm.]]' => 'Confirm',
  '[[.please_enter_confirm_code.]]' => 'Please enter confirm code',
  '[[.please_enter_email.]]' => 'Please enter email',
  '[[.dashboard.]]' => 'Dashboard',
  '[[.account_information.]]' => 'Account information',
  '[[.address_book.]]' => 'Address book',
  '[[.wishlist.]]' => 'Wishlist',
  '[[.product_reviews.]]' => 'Product reviews',
  '[[.my_account.]]' => 'My account',
  '[[.orders.]]' => 'Orders',
  '[[.edit_account_information.]]' => 'Edit account information',
  '[[.company.]]' => 'Company',
  '[[.fax.]]' => 'Fax',
  '[[.country.]]' => 'Country',
  '[[.city.]]' => 'City',
  '[[.billing.]]' => 'Billing',
  '[[.shipping.]]' => 'Shipping',
  '[[.edit_address.]]' => 'Edit address',
  '[[.same_billing.]]' => 'Same billing',
  '[[.zone_admin.]]' => 'Zone admin',
  '[[.New.]]' => 'New',
  '[[.Trash.]]' => 'Trash',
  '[[.cache.]]' => 'Cache',
  '[[.Help.]]' => 'Help',
  '[[.quick_add.]]' => 'Quick add',
  '[[.parent_category.]]' => 'Parent category',
  '[[.region_name.]]' => 'Region name',
  '[[.parent.]]' => 'Parent',
  '[[.your_comments_are_not_sent.]]' => 'Your comments are not sent',
  '[[.add_to_wishlist.]]' => 'Add to wishlist',
  '[[.image.]]' => 'Image',
  '[[.product_information_and_notes.]]' => 'Product information and notes',
  '[[.are_you_sure_you_want_to_remove_this_product_from_your_wishlist.]]' => 'Are you sure you want to remove this product from your wishlist?',
  '[[.abc.]]' => 'Abc',
  '[[.thanks_for_your_comment.]]' => 'Thanks for your comment',
  '[[.my_order.]]' => 'My order',
  '[[.date.]]' => 'Date',
  '[[.ship_to.]]' => 'Ship to',
  '[[.order_total.]]' => 'Order total',
  '[[.order_status.]]' => 'Order status',
  '[[.generate.]]' => 'Generate',
  '[[.discount_code.]]' => 'Discount code',
  '[[.enter_your_coupon_code_if_you_have_one.]]' => 'enter your coupon code if you have one',
  '[[.apply_coupon.]]' => 'Apply coupon',
  '[[.billing_information.]]' => 'Billing information',
  '[[.shipping_information.]]' => 'shipping information',
  '[[.order_review.]]' => 'Order review',
  '[[.checkout.]]' => 'Checkout',
  '[[.new_address.]]' => 'New address',
  '[[.apply.]]' => 'Apply',
  '[[.discount_code_and_confirm.]]' => 'Discount code and confirm',
  '[[.discount_code_and_user_confirm.]]' => 'Discount code and confirm',
  '[[.place_order.]]' => 'Place order',
  '[[.check_discount_code.]]' => 'Check discount code',
  '[[.billing_full_name.]]' => 'Billing full name',
  '[[.shipping_full_name.]]' => 'Shipping full name',
  '[[.billing_to_name.]]' => 'Billing to name',
  '[[.shipping_to_name.]]' => 'Shipping to name',
  '[[.discount.]]' => 'Discount',
  '[[.ruler_name.]]' => 'Ruler name',
  '[[.priority.]]' => 'Priority',
  '[[.ruler_information.]]' => 'Ruler information',
  '[[.conditions.]]' => 'Conditions',
  '[[.apply_discount_code.]]' => 'Apply discount code',
  '[[.cancel.]]' => 'Cancel',
  '[[.subtotal.]]' => 'Subtotal',
  '[[.PENDING.]]' => 'Pending',
  '[[.PROCESSING.]]' => 'Processing',
  '[[.COMPLETE.]]' => 'Complete',
  '[[.CANCEL.]]' => 'Cancel',
  '[[.search.]]' => 'Search',
  '[[.my_cart.]]' => 'My cart',
  '[[.no_data.]]' => 'No data',
  '[[.recent_orders.]]' => 'Recent orders',
  '[[.my_dashboard.]]' => 'My dashboard',
  '[[.billing_address.]]' => 'Billing address',
  '[[.shipping_address.]]' => 'Shipping address',
  '[[.month_1.]]' => 'January',
  '[[.month_2.]]' => 'February',
  '[[.month_3.]]' => 'March',
  '[[.month_4.]]' => 'April',
  '[[.month_5.]]' => 'May',
  '[[.month_6.]]' => 'June',
  '[[.month_7.]]' => 'July',
  '[[.month_8.]]' => 'August',
  '[[.month_9.]]' => 'September',
  '[[.month_10.]]' => 'October',
  '[[.month_11.]]' => 'November',
  '[[.month_12.]]' => 'December',
  '[[.page_view_day_in_month.]]' => 'Page view day in month',
  '[[.year.]]' => 'Year',
  '[[.page_view.]]' => 'Page view',
  '[[.current.]]' => '',
  '[[.confirm_register_with_email.]]' => 'Confirm register with email',
  '[[.product_compare.]]' => 'Product compare',
  '[[.product_to_compare.]]' => 'Product to compare',
  '[[.sort_by.]]' => 'Sort by',
  '[[.compare_product.]]' => 'Compare product',
  '[[.no_delete.]]' => 'No delete',
  '[[.preview_page.]]' => 'Preview page',
  '[[.me.]]' => 'Me',
  '[[.supporter.]]' => 'Supporter',
  '[[.Filter.]]' => 'Filter',
  '[[.Go.]]' => 'Go',
  '[[.time.]]' => 'Time',
  '[[.parttern_small_thumb_url.]]' => 'Parttern small thumb url',
  '[[.display.]]' => 'Display',
  '[[.of.]]' => 'Of',
  '[[.Save.]]' => 'Save',
  '[[.page_num.]]' => 'Page num',
  '[[.pattern_bound.]]' => 'Pattern bound',
  '[[.pattern_a_link.]]' => 'Pattern a link',
  '[[.image_content_replace.]]' => 'Image content replace',
  '[[.begin_end.]]' => 'Begin end',
  '[[.Vui lòng nhập tên mẫu.]]' => 'Vui lòng nhập tên mẫu',
  '[[.Vui lòng nhập tên trang cần lấy dữ liệu.]]' => 'Vui lòng nhập tên trang cần lấy dữ liệu',
  '[[.Vui lòng nhập đường dẫn cần lấy dữ liệu.]]' => 'Vui lòng nhập đường dẫn cần lấy dữ liệu',
  '[[.Vui lòng nhập mẫu bao ngoài một đối tượng.]]' => 'Vui lòng nhập mẫu bao ngoài một đối tượng',
  '[[.Vui lòng nhập mẫu liên kết một tin.]]' => 'Vui lòng nhập mẫu liên kết một tin',
  '[[.Vui lòng nhập tên bảng muốn chèn dữ liệu.]]' => 'Vui lòng nhập tên bảng muốn chèn dữ liệu',
  '[[.text.]]' => 'Text',
  '[[.element.]]' => 'Element',
  '[[.extra.]]' => 'Extra',
  '[[.element_delete.]]' => 'Element delete',
  '[[.object_not_exists.]]' => 'Object not exists',
  '[[.download.]]' => 'Download',
  '[[.Fri.]]' => 'Friday',
  '[[.search..]]' => 'Search ...',
  '[[.Sat.]]' => 'Saturday',
  '[[.lich_khai_giang.]]' => 'Lịch khai giảng',
  '[[.our_clients.]]' => 'Our clients',
  '[[.Thu.]]' => 'Thursday',
  '[[.notice.]]' => 'Notice',
  '[[.yahoo_support_online.]]' => 'Yahoo support online',
  '[[.video_clip.]]' => 'Video clip',
  '[[.Sun.]]' => 'Sunday',
  '[[.register_get_newsletter.]]' => 'Register get newsletter',
  '[[.we_are_not_spam.]]' => 'We are not spam',
  '[[.register_for_get_newsletter.]]' => 'Register for get newsletter',
  '[[.register_for_get_free_newsletter.]]' => 'Register for get free newsletter',
  '[[.you_are_registered_get_free_newsletter.]]' => 'You are registered get free newsletter',
  '[[.preview.]]' => 'Preview',
  '[[.next.]]' => 'Next',
  '[[.Mon.]]' => 'Monday',
  '[[.you_are_not_deleted_get_newsletter.]]' => 'You are not deleted get newsletter',
  '[[.you_are_deleted_get_newsletter.]]' => 'You are deleted get newsletter',
  '[[.register_exam_online_with_netpro_iti_academy.]]' => 'Register exam online with netpro iti academy',
  '[[.enter_information_in_form.]]' => 'Enter information in form',
  '[[.job.]]' => 'Job',
  '[[.training_program.]]' => 'Training program',
  '[[.contact_when.]]' => 'Contact when',
  '[[.you_know_academy_from.]]' => 'What do you know academy from?',
  '[[.user_confirm.]]' => 'User confirm',
  '[[.in_the_form.]]' => 'In the form',
  '[[.morning.]]' => 'Morning',
  '[[.afternoon.]]' => 'Afternoon',
  '[[.midday.]]' => 'Midday',
  '[[.evening.]]' => 'Evening',
  '[[.internet_source.]]' => 'Internet (forum, website, google....)',
  '[[.press.]]' => 'Press',
  '[[.television.]]' => 'Television',
  '[[.friend.]]' => 'Friend',
  '[[.academy.]]' => 'Academy',
  '[[.letter_from_academy.]]' => 'Letter from academy',
  '[[.others.]]' => 'Others',
  '[[.noon.]]' => 'Noon',
  '[[.academy_center.]]' => 'Academy center',
  '[[.letter_center.]]' => 'Letter center',
  '[[.other.]]' => 'Other',
  '[[.your_information_registered.]]' => 'Your information registered',
  '[[.Tue.]]' => 'Tuesday',
  '[[.Wed.]]' => 'Wednesday',
  '[[.Trịnh Công Minh.]]' => '',
  '[[.copy.]]' => '',
  '[[.copy_value.]]' => '',
  '[[.this_attribute_name_is_exists.]]' => '',
  '[[.copy_attribute.]]' => '',
  '[[.please_enter_run_func.]]' => '',
  '[[.effect_image.]]' => '',
  '[[.please_enter_title.]]' => '',
  '[[.Vui lòng nhập tên miền trang cần lấy dữ liệu.]]' => '',
  '[[.ham_thuc_thi_phai_bat_dau_bang_cron.]]' => '',
  '[[.sport.]]' => '',
  '[[.sport_today.]]' => '',
  '[[.Vui lòng nhập tên tiến trình.]]' => '',
  '[[.product_category.]]' => '',
  '[[.invalid_end_time.]]' => '',
  '[[.invalid_start_time.]]' => '',
  '[[.Tài khoản hoặc mật khẩu không đúng.]]' => '',
  '[[.tin_hoat_dong_hoi.]]' => '',
  '[[.file_size_too_large.]]' => '',
  '[[.File size too large.]]' => '',
  '[[.this_name_is_exists.]]' => '',
  '[[.hot_new.]]' => '',
  '[[.new_product.]]' => '',
  '[[.welcome_to_eresson.]]' => '',
  '[[.introduction.]]' => '',
  '[[.event.]]' => '',
  '[[.recruitment.]]' => '',
  '[[.Welcome.]]' => '',
  '[[.OurTravelResorts.]]' => '',
  '[[.readmore.]]' => '',
  '[[.video.]]' => '',
  '[[.patient_share.]]' => '',
  '[[.send_question.]]' => '',
  '[[.video_gallery.]]' => '',
  '[[.TuVan.]]' => '',
  '[[.others_news.]]' => '',
  '[[.partner.]]' => '',
  '[[.student_information.]]' => '',
  '[[.course_information.]]' => '',
  '[[.dang_ky_tuyen_sinh.]]' => '',
  '[[.register_successfull.]]' => '',
  '[[.set_as_homepage.]]' => '',
  '[[.test_online.]]' => '',
);
}
?>