--
-- PostgreSQL database dump
--

-- Dumped from database version 14.0
-- Dumped by pg_dump version 14.0

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: media; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (13, '{"required":false,"type":"Boolean","default":null}', '[用户管理]是否有设置用户权限功能', 'users.bsetpermission', 'api', '2020-03-24 05:52:21', '2020-03-24 05:52:21');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (32, '{"required":false,"type":"number","default":null}', '[用户信息]管理单位根节点', 'profile.iManageUnit', 'api', '2020-04-02 07:57:05', '2020-04-02 07:57:05');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (33, '{"required":false,"type":"Boolean","default":null}', '[用户信息]是否有设置用户单位功能', 'profile.bsetunit', 'api', '2020-04-02 07:57:05', '2020-04-02 07:57:05');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (34, '{"required":false,"type":"Boolean","default":null}', '[用户管理]是否有添加功能', 'users.badd', 'api', '2020-04-02 07:58:06', '2020-04-02 07:58:06');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (35, '{"required":false,"type":"Boolean","default":null}', '[用户管理]是否有删除功能', 'users.bDelete', 'api', '2020-04-02 07:58:06', '2020-04-02 07:58:06');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (36, '{"required":false,"type":"Boolean","default":null}', '[用户管理]是否有修改功能', 'users.bmodify', 'api', '2020-04-02 07:58:06', '2020-04-02 07:58:06');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (37, '{"required":false,"type":"Boolean","default":null}', '[用户管理]是否有设置用户角色功能', 'users.bsetrole', 'api', '2020-04-02 07:58:06', '2020-04-02 07:58:06');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (38, '{"required":false,"type":"Boolean","default":null}', '[角色管理]是否有添加功能', 'role.badd', 'api', '2020-04-02 07:58:10', '2020-04-02 07:58:10');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (39, '{"required":false,"type":"Boolean","default":null}', '[角色管理]是否有模块设置功能', 'role.bSetTree', 'api', '2020-04-02 07:58:10', '2020-04-02 07:58:10');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (40, '{"required":false,"type":"Boolean","default":null}', '[角色管理]是否有删除功能', 'role.bDelete', 'api', '2020-04-02 07:58:10', '2020-04-02 07:58:10');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (41, '{"required":false,"type":"Boolean","default":null}', '[角色管理]是否有修改功能', 'role.bmodify', 'api', '2020-04-02 07:58:10', '2020-04-02 07:58:10');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (42, '{"required":false,"type":"Boolean","default":null}', '[模块管理]是否有添加功能', 'modules.badd', 'api', '2020-04-02 07:58:12', '2020-04-02 07:58:12');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (43, '{"required":false,"type":"Boolean","default":null}', '[模块管理]是否有删除功能', 'modules.bDelete', 'api', '2020-04-02 07:58:12', '2020-04-02 07:58:12');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (44, '{"required":false,"type":"Boolean","default":null}', '[模块管理]是否有修改功能', 'modules.bmodify', 'api', '2020-04-02 07:58:12', '2020-04-02 07:58:12');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (45, '{"required":false,"type":"Boolean","default":null}', '[模块管理]是否有导出功能', 'modules.bexport', 'api', '2020-04-02 07:58:12', '2020-04-02 07:58:12');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (46, '{"required":false,"type":"Boolean","default":null}', '[模块管理]是否有导入功能', 'modules.bimport', 'api', '2020-04-02 07:58:12', '2020-04-02 07:58:12');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (47, '{"required":false,"type":"Boolean","default":null}', '[模块管理]是否有调整树功能', 'modules.bSetTree', 'api', '2020-04-02 07:58:12', '2020-04-02 07:58:12');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (48, '{"required":false,"type":"Boolean","default":null}', '[权限管理]是否有添加功能', 'permission.badd', 'api', '2020-04-02 07:58:12', '2020-04-02 07:58:12');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (49, '{"required":false,"type":"Boolean","default":null}', '[权限管理]是否有修改功能', 'permission.bmodify', 'api', '2020-04-02 07:58:13', '2020-04-02 07:58:13');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (50, '{"required":false,"type":"Boolean","default":null}', '[权限管理]是否有导出功能', 'permission.bexport', 'api', '2020-04-02 07:58:13', '2020-04-02 07:58:13');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (51, '{"required":false,"type":"Boolean","default":null}', '[权限管理]是否有设置权限JSON树功能', 'permission.bJsonedit', 'api', '2020-04-02 07:58:13', '2020-04-02 07:58:13');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (52, '{"required":false,"type":"Boolean","default":null}', '[权限管理]是否有删除功能', 'permission.bDelete', 'api', '2020-04-02 07:58:13', '2020-04-02 07:58:13');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (53, '{"required":false,"type":"Boolean","default":null}', '[单位管理]是否有调整机构树功能', 'units.bSetTree', 'api', '2020-04-02 07:58:13', '2020-04-02 07:58:13');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (54, '{"required":false,"type":"Boolean","default":null}', '[单位管理]是否有修改功能', 'units.bmodify', 'api', '2020-04-02 07:58:13', '2020-04-02 07:58:13');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (55, '{"required":false,"type":"Boolean","default":null}', '[单位管理]是否有导出功能', 'units.bexport', 'api', '2020-04-02 07:58:13', '2020-04-02 07:58:13');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (56, '{"required":false,"type":"Boolean","default":null}', '[单位管理]是否有添加功能', 'units.badd', 'api', '2020-04-02 07:58:13', '2020-04-02 07:58:13');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (57, '{"required":false,"type":"Boolean","default":null}', '[单位管理]是否有删除功能', 'units.bDelete', 'api', '2020-04-02 07:58:13', '2020-04-02 07:58:13');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (58, '{"required":false,"type":"Boolean","default":null}', '[文章列表]是否有添加功能', 'articlelist.badd', 'api', '2020-04-02 07:58:16', '2020-04-02 07:58:16');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (59, '{"required":false,"type":"Boolean","default":null}', '[文章列表]是否有导出功能', 'articlelist.bexport', 'api', '2020-04-02 07:58:16', '2020-04-02 07:58:16');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (60, '{"required":false,"type":"Boolean","default":null}', '[文章列表]是否有删除功能', 'articlelist.bDelete', 'api', '2020-04-02 07:58:16', '2020-04-02 07:58:16');
INSERT INTO public.permissions (id, syscfg, title, name, guard_name, created_at, updated_at) VALUES (61, '{"required":false,"type":"Boolean","default":null}', '[文章列表]是否有修改功能', 'articlelist.bmodify', 'api', '2020-04-02 07:58:16', '2020-04-02 07:58:16');


--
-- Data for Name: model_has_permissions; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (42, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (43, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (44, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (45, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (46, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (47, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (13, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (34, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (35, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (36, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (37, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (48, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (49, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (50, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (51, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (52, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (53, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (54, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (55, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (56, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (57, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (38, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (39, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (40, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (41, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (32, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (33, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (58, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (59, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (60, 'App\Models\User', '1', 1);
INSERT INTO public.model_has_permissions (permission_id, model_type, usrcfg, model_id) VALUES (61, 'App\Models\User', '1', 1);


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.roles (id, name, title, guard_name, created_at, updated_at) VALUES (1, 'admin', '超级管理员', 'api', '2020-02-25 14:07:37', '2020-02-25 14:07:37');
INSERT INTO public.roles (id, name, title, guard_name, created_at, updated_at) VALUES (2, 'test1', '测试角色1', 'api', '2020-02-25 14:15:15', '2020-02-25 14:15:15');
INSERT INTO public.roles (id, name, title, guard_name, created_at, updated_at) VALUES (3, 'test2', '测试角色2', 'api', '2020-02-25 14:15:18', '2020-02-25 14:15:18');
INSERT INTO public.roles (id, name, title, guard_name, created_at, updated_at) VALUES (4, 'test3', '测试角色3', 'api', '2020-02-25 14:15:19', '2020-02-25 14:15:19');
INSERT INTO public.roles (id, name, title, guard_name, created_at, updated_at) VALUES (5, 'test4', '测试角色4', 'api', '2020-02-25 14:16:50', '2020-02-25 14:16:50');


--
-- Data for Name: model_has_roles; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.model_has_roles (role_id, model_type, model_id) VALUES (3, 'App\Models\User', 3);
INSERT INTO public.model_has_roles (role_id, model_type, model_id) VALUES (4, 'App\Models\User', 3);
INSERT INTO public.model_has_roles (role_id, model_type, model_id) VALUES (4, 'App\Models\User', 4);
INSERT INTO public.model_has_roles (role_id, model_type, model_id) VALUES (5, 'App\Models\User', 4);
INSERT INTO public.model_has_roles (role_id, model_type, model_id) VALUES (3, 'App\Models\User', 2);
INSERT INTO public.model_has_roles (role_id, model_type, model_id) VALUES (2, 'App\Models\User', 2);
INSERT INTO public.model_has_roles (role_id, model_type, model_id) VALUES (1, 'App\Models\User', 2);
INSERT INTO public.model_has_roles (role_id, model_type, model_id) VALUES (4, 'App\Models\User', 2);
INSERT INTO public.model_has_roles (role_id, model_type, model_id) VALUES (5, 'App\Models\User', 2);
INSERT INTO public.model_has_roles (role_id, model_type, model_id) VALUES (5, 'App\Models\User', 1);
INSERT INTO public.model_has_roles (role_id, model_type, model_id) VALUES (4, 'App\Models\User', 1);
INSERT INTO public.model_has_roles (role_id, model_type, model_id) VALUES (3, 'App\Models\User', 1);
INSERT INTO public.model_has_roles (role_id, model_type, model_id) VALUES (2, 'App\Models\User', 1);
INSERT INTO public.model_has_roles (role_id, model_type, model_id) VALUES (1, 'App\Models\User', 1);


--
-- Data for Name: oauth_clients; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.oauth_clients (id, user_id, name, secret, provider, redirect, personal_access_client, password_client, revoked, created_at, updated_at) VALUES (1, NULL, 'xone Personal Access Client', 'vbCi14KPPmSu5xyUUXZJ0o0laljr1wQVr9fTnl9Q', NULL, 'http://localhost', true, false, false, '2022-07-19 14:04:26', '2022-07-19 14:04:26');
INSERT INTO public.oauth_clients (id, user_id, name, secret, provider, redirect, personal_access_client, password_client, revoked, created_at, updated_at) VALUES (2, NULL, 'xone Password Grant Client', 'XniZcYuqhk5Ox3B1whpdIlbApQ8Rop0DMsh2kEzh', 'users', 'http://localhost', false, true, false, '2022-07-19 14:04:26', '2022-07-19 14:04:26');


--
-- Data for Name: z_modules; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (3, 'modules', '模块管理', NULL, 'A', 'build', 'modules', NULL, 5, 6, 2, '2020-01-26 22:09:30', '2020-02-21 14:06:22');
INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (4, 'users', '用户管理', NULL, 'A', 'group', 'users', NULL, 11, 12, 2, '2020-02-09 14:38:11', '2020-02-22 15:28:43');
INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (13, 'permission', '权限管理', NULL, 'A', 'settings', 'permission', NULL, 7, 8, 2, '2020-02-21 14:04:23', '2020-02-22 15:29:06');
INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (5, 'units', '单位管理', NULL, 'A', 'apartment', 'units', NULL, 9, 10, 2, '2020-02-09 14:39:58', '2020-02-22 15:33:13');
INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (11, 'role', '角色管理', NULL, 'A', 'important_devices', 'role', NULL, 3, 4, 2, '2020-02-21 14:04:23', '2020-02-22 15:37:18');
INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (12, 'profile', '用户信息', NULL, 'A', 'recent_actors', 'profile', NULL, 13, 14, 2, '2020-02-21 14:04:23', '2020-02-22 15:42:59');
INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (14, 'articlelist', '文章列表', NULL, 'A', 'folder_special', 'articlelist', NULL, 15, 16, 2, '2020-02-24 06:04:34', '2020-03-24 05:55:06');
INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (2, 'system', '系统管理', NULL, 'A', 'view_module', NULL, NULL, 2, 19, 1, '2020-01-26 21:55:22', '2020-04-02 07:59:47');
INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (8, 'userprofile', '个人信息', NULL, 'B', 'person_outline', 'userprofile', NULL, 20, 21, 1, '2020-02-14 16:00:40', '2020-04-02 07:59:47');
INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (9, 'message', '消息中心', NULL, 'B', 'message', 'message', NULL, 22, 23, 1, '2020-02-14 16:01:34', '2020-04-02 07:59:47');
INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (10, 'help', '帮助中心', NULL, 'B', 'help', 'help', NULL, 24, 25, 1, '2020-02-14 16:02:50', '2020-04-02 07:59:47');
INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (7, 'changepwd', '更改密码', NULL, 'B', 'vpn_key', 'changepwd', NULL, 26, 27, 1, '2020-02-14 15:59:21', '2020-04-02 07:59:47');
INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (6, 'notepad', '测试模块', NULL, 'B', 'event_note', 'notepad', NULL, 28, 29, 1, '2020-02-14 15:58:03', '2020-04-02 07:59:47');
INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (23, 'phonecomlicaton', '手机应用', NULL, 'A', 'phone_android', 'phonecomlicaton', NULL, 17, 18, 2, '2020-04-02 07:55:40', '2020-04-02 08:06:12');
INSERT INTO public.z_modules (id, name, title, tip, ismenu, icon, url, memo, _lft, _rgt, parent_id, created_at, updated_at) VALUES (1, 'root', '根系统', NULL, 'A', 'home', NULL, NULL, 1, 30, NULL, '2020-01-26 22:03:18', '2020-12-01 23:05:44');


--
-- Data for Name: role_z_module; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (2, 3);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (2, 13);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (2, 11);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (2, 2);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (2, 8);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (2, 9);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (2, 10);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (2, 7);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (2, 1);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (3, 4);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (3, 13);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (3, 5);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (3, 2);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (3, 8);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (3, 9);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (3, 7);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (3, 1);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (4, 4);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (4, 12);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (4, 14);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (4, 2);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (4, 8);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (4, 7);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (4, 1);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (5, 4);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (5, 12);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (5, 2);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (5, 8);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (5, 7);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (5, 1);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 3);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 4);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 13);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 5);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 11);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 12);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 14);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 2);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 8);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 9);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 10);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 7);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 6);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 23);
INSERT INTO public.role_z_module (role_id, z_module_id) VALUES (1, 1);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.users (id, name, email, usercfg, email_verified_at, password, remember_token, created_at, updated_at) VALUES (3, '33', '3@3.com', NULL, NULL, '$2y$10$TIqHWiRgmZa0O67hSJ9wB.nRgLiCaqh5Pqx2YJwIm/Rr8r2ynONCi', NULL, '2020-02-25 14:06:21', '2020-02-25 14:06:21');
INSERT INTO public.users (id, name, email, usercfg, email_verified_at, password, remember_token, created_at, updated_at) VALUES (4, '44', '4@4.com', NULL, NULL, '$2y$10$cPmvOYJzl0iK6PxYa5teOunHE0rlYTEgjADAoTLX5oxFz2Mhwl6/i', NULL, '2020-02-25 14:06:34', '2020-02-25 14:06:34');
INSERT INTO public.users (id, name, email, usercfg, email_verified_at, password, remember_token, created_at, updated_at) VALUES (1, '11', '1@1.com', '{"quickapplication":[{"id":38,"name":"p3s1proj_data","title":"项目数据","tip":null,"ismenu":"A","icon":"library_books","url":"p3s1/p3s1proj_data","memo":null,"_lft":49,"_rgt":50,"parent_id":34,"children":[]},{"id":39,"name":"p3s1checked_data","title":"已检数据","tip":null,"ismenu":"A","icon":"playlist_add_check","url":"p3s1/p3s1checked_data","memo":null,"_lft":51,"_rgt":52,"parent_id":34,"children":[]}]}', NULL, '$2y$10$B/0mHy.9GpDW7tS4N7SSiOzA5xS46c6IFSQe/XJYi.GFP84MsUA4C', NULL, '2020-01-24 08:12:56', '2020-11-27 11:28:49');
INSERT INTO public.users (id, name, email, usercfg, email_verified_at, password, remember_token, created_at, updated_at) VALUES (2, '22', '2@2.com', '{"theme":"Bright","dark":false}', NULL, '$2y$10$Co/4Yv77LDf3EbXK5MvyqOxrxyqwKbERIPAuyBivBbiTXVx3zYlfC', NULL, '2020-02-25 14:06:05', '2020-11-16 21:20:20');


--
-- Data for Name: z_units; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.z_units (id, title, brief, _lft, _rgt, parent_id, created_at, updated_at) VALUES (4, '二级单位1', '测试用', 3, 4, 2, '2020-02-25 14:12:10', '2020-03-04 03:30:26');
INSERT INTO public.z_units (id, title, brief, _lft, _rgt, parent_id, created_at, updated_at) VALUES (5, '二级单位2', '测试用', 5, 6, 2, '2020-02-25 14:12:10', '2020-03-04 03:30:26');
INSERT INTO public.z_units (id, title, brief, _lft, _rgt, parent_id, created_at, updated_at) VALUES (2, '一级单位1', '测试用', 2, 7, 1, '2020-02-25 14:12:10', '2020-03-04 03:30:26');
INSERT INTO public.z_units (id, title, brief, _lft, _rgt, parent_id, created_at, updated_at) VALUES (3, '一级单位2', '测试用', 8, 9, 1, '2020-02-25 14:12:10', '2020-03-04 03:30:26');
INSERT INTO public.z_units (id, title, brief, _lft, _rgt, parent_id, created_at, updated_at) VALUES (1, '根单位', '所有单位的根', 1, 10, NULL, '2020-02-25 14:11:07', '2020-03-04 03:30:26');


--
-- Data for Name: user_z_unit; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.user_z_unit (user_id, z_unit_id) VALUES (1, 1);


--
-- Data for Name: z_userprofiles; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.z_userprofiles (id, no, avatar, name, sex, "position", title, jobs, unitid, phone, tel, birth, address, memo, companyname, province, city, area, created_at, updated_at) VALUES (2, NULL, 'statics/default_avatar.jpg', '22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-25 14:06:05', '2020-02-25 14:06:05');
INSERT INTO public.z_userprofiles (id, no, avatar, name, sex, "position", title, jobs, unitid, phone, tel, birth, address, memo, companyname, province, city, area, created_at, updated_at) VALUES (3, NULL, 'statics/default_avatar.jpg', '33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-25 14:06:21', '2020-02-25 14:06:21');
INSERT INTO public.z_userprofiles (id, no, avatar, name, sex, "position", title, jobs, unitid, phone, tel, birth, address, memo, companyname, province, city, area, created_at, updated_at) VALUES (4, NULL, 'statics/default_avatar.jpg', '44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-25 14:06:34', '2020-02-25 14:06:34');
INSERT INTO public.z_userprofiles (id, no, avatar, name, sex, "position", title, jobs, unitid, phone, tel, birth, address, memo, companyname, province, city, area, created_at, updated_at) VALUES (1, NULL, 'statics/default_avatar.jpg', '人生格言', 'm', NULL, NULL, NULL, NULL, '138 - 0800 0900', '02884072248,02884075689,15898765768', '1980-08-18', 'xxxx', 'test', '测试公司', NULL, NULL, NULL, NULL, '2020-10-09 23:02:45');


--
-- Name: media_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.media_id_seq', 45, true);


--
-- Name: oauth_clients_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.oauth_clients_id_seq', 2, true);


--
-- Name: permissions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.permissions_id_seq', 66, true);


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.roles_id_seq', 7, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.users_id_seq', 15, true);


--
-- Name: z_modules_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.z_modules_id_seq', 42, true);


--
-- Name: z_units_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.z_units_id_seq', 6, true);


--
-- PostgreSQL database dump complete
--

